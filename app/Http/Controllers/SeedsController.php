<?php

namespace App\Http\Controllers;

use SimplePie;
use App\Seed;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Form;
use Html;
use DOMDocument;

class SeedsController extends Controller
{
    protected $status_list = array(
        0 => ["danger" => 'seeds.label.deactivate'],
        1 => ["success" => 'seeds.label.activate'],
    );
    protected $columns_list = array(
        1 => "id",
        2 => "updated_at",
        3 => "title",
        4 => "category",
        6 => "feeds_count",
        7 => "status",
    );


    public function index()
    {
        $categories = Category::all(['id','title']);
        return view('dashboard.seeds.index', ['status' => $this->status_list,'categories'=>$categories]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function ajax(Request $request)
    {
        $sEcho = intval($_REQUEST['draw']);
        $records = array();
        $records["data"] = array();
        $recordsTotal = Seed::all()->count();
        $records["recordsTotal"] = $recordsTotal;
        $items = new Seed();
        if (Input::has('action')) {
            $action = Input::get('action');
            if ($action == 'filter') {
                if (Input::has('item_id')) {
                    $items = $items->where('id', '=', Input::get('item_id'));
                }
                if (Input::has('updated_date_from')) {
                    $items = $items->where('updated_at', '>', Carbon::createFromFormat('d/m/Y H:i:s', Input::get('updated_date_from') . ' 00:00:00'));
                }
                if (Input::has('updated_date_to')) {
                    $items = $items->where('updated_at', '<', Carbon::createFromFormat('d/m/Y H:i:s', Input::get('updated_date_to') . ' 23:59:59'));
                }
                if (Input::has('title')) {
                    $items = $items->where('title', 'LIKE', '%' . Input::get('title') . '%');
                }
                if (Input::has('status')) {
                    $items = $items->where('status', '=', Input::get('status'));
                }
                if (Input::has('category')) {
                    $items = $items->where('category_id', '=', Input::get('category'));
                }
                // childes_no_from
                // childes_no_to
                // seeds_no_from
                // seeds_no_to
                // feeds_no_from
                // feeds_no_to
            }

        }
        if (Input::has('customActionType')) {
            if (Input::get('customActionType') == 'group_action') {
                if (Input::has('customActionName')) {
                    if (Input::has('id')) {
                        if (is_array(Input::get('id'))) {
                            $ids = Input::get('id');
                            $action_items = new Seed();
                            $action_items = $action_items->whereIn("id", $ids);
                        }
                    }
                    if (Input::get('customActionName') == 'activate') {
                        $action_items = $action_items->update(array('status' => 1));
                        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                        $records["customActionMessage"] = trans('seeds.index.success_bulk_activate'); // pass custom message(useful for getting status of group actions)
                    }
                    if (Input::get('customActionName') == 'deactivate') {
                        $action_items = $action_items->update(array('status' => 0));
                        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                        $records["customActionMessage"] = trans('seeds.index.success_bulk_deactivate'); // pass custom message(useful for getting status of group actions)
                    }
                    if (Input::get('customActionName') == 'delete') {
                        $action_items->feeds()->update(['seed_id'=>0]);
                        $action_items->destroy();
                        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                        $records["customActionMessage"] = trans('seeds.index.success_bulk_delete'); // pass custom message(useful for getting status of group actions)
                    }
                }
            }
        }
        $records["recordsFiltered"] = $items->count();
        $items = $items->orderBy($this->columns_list[current($request->order)['column']], current($request->order)['dir']);
        $items = $items->limit($_REQUEST['length'])->offset($_REQUEST['start']);
        $items = $items->get();
        foreach ($items as $item) {
            $records["data"][] = array(
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $item['id'] . '"/><span></span></label>',
                $item['id'],
                $item->updated_at->diffForHumans() . '<br><small>' . $item->updated_at->toDayDateTimeString() . '</small>',
                $item['title'],
                $item->category->title,
                $item->feeds()->count().'<a href="' . route('seeds.reload', ['slug' => $item['slug']]) . '" class="btn btn-sm btn-outline btn-success "><i class="fa fa-search"></i> ' . trans('seeds.reload') . ' </a>',
                '<span class="label label-sm label-' . key($this->status_list[$item['status']]) . '">' .
                trans(current($this->status_list[$item['status']])) .
                '</span>',
                '<a href="' . route('seeds.show', ['id' => $item['slug']]) . '" class="btn btn-sm btn-outline btn-success "><i class="fa fa-search"></i> ' . trans('app.read') . ' </a>'
                . '<a href="' . route('seeds.edit', ['id' => $item['slug']]) . '" class="btn btn-sm btn-outline btn-warning "><i class="fa fa-pencil-square-o"></i> ' . trans('app.update') . ' </a>'
                . Form::open(['route' => ['seeds.destroy',$item['slug']], 'method' => 'DELETE', 'style'=>'display:inline']).
                Form::submit(trans('app.delete'), ['class' => 'btn btn-sm btn-outline btn-danger']).
                Form::close()
            ); // row data
        }
        $records["draw"] = $sEcho;
        $records["dev"] = '';
        return json_encode($records);
    }

    public function create()
    {
        $items = Category::all(['id', 'title']);
        if (count($items) > 0){
            return view('dashboard.seeds.create', ['categories' => $items]);
        }
        return redirect()->route('categories.create')->with('warning', trans('seeds.category_first'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "bail|required|unique:seeds|max:255",
            "url" => "required|url|responded|unique:seeds",
            "category_id" => "required|exists:categories,id",
            "description" => "required",
            "reload" => "required|numeric",
            "status" => "nullable|accepted",
        ]);
        if ($validator->fails()) {
            return redirect()->route('seeds.create')->withErrors($validator)->withInput();
        }
        $item = new Seed([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'reload' => $request->input('reload'),
            'status' => ($request->input('status')) ? 1 : 0,
        ]);
        $item->save();
        return redirect()->route('seeds.index')->with('success', trans('seeds.create.success'));
    }

    public function reload($seed)
    {
//        $seed = Seed::where('slug', '=', $slug)->first();
        if($seed == null){
            return redirect()->route('seeds.index')->with('error',trans('seeds.not_found'));
        }
        $feeds = new SimplePie();
        $feeds->set_feed_url($seed->url);
//        $feeds->enable_order_by_date(true);
        $feeds->set_timeout(1800);
        $feeds->set_output_encoding('utf-8');
        $feeds->enable_cache(false);
//        $feeds->set_cache_location(storage_path('cache'));
//        $feeds->set_image_handler(true);
        $feeds->force_feed(true);
        $feeds->strip_htmltags(array_merge($feeds->strip_htmltags, array('a')));
//        $feeds->strip_comments(true);

        $feeds->init();
        $feeds->handle_content_type();

        if($feeds->error()){
            return redirect()->route('seeds.index')->with('error',$feeds->error());
        }
        $feeds = $feeds->get_items();
        $success = 0;
        $errors = array();

        foreach ($feeds as $item)
        {
            $images  = array();
            $image = '';
            if ($enclosure = $item->get_enclosure())
            {
                $src = $enclosure->get_link();
                if($src){
                    list($width, $height) = @getimagesize($src);
                    if($width >= 80 || $height >= 80){
                        $images[] = ['src' => $src, 'width' => $width,'height' => $height];
                    }
                }
            }
            $doc = new DOMDocument();
            @$doc->loadHTML(($item->get_content())? $item->get_content() : $item->get_description());
            $tags = $doc->getElementsByTagName('img');
            if($tags->length > 0){
                foreach ($tags as $tag) {
                    $link = $tag->getAttribute('src');
                    if($link){
                        list($width, $height) = @getimagesize($link);
                        if($width >= 100 || $height >= 100){
                            $images[] = ['src' => $link, 'width' => $width,'height' => $height];
                        }
                    }
                }
            }
            if(count($images) > 0){
                $images = array_values(array_sort($images, function ($value) {
                    return $value['width'];
                }));
                $image = $images[0]['src'];
            }


            $author = ($item->get_author()) ? $item->get_author() : null;

            $insert = [
                'feed_id' => $item->get_id(true),
                'category_id' => $seed->category->id,
                'url' => urlencode($item->get_permalink()),
                'title' => $item->get_title(),
                'description' => Html::entities($item->get_description()),
                'image' => ($image) ? $image : null,
                'author' => ($author) ? $author->get_name() : null,
                'author_link' => ($author) ? $author->get_link() : null,
                'publishing_date' => ($item->get_date()) ? $item->get_date() : ($item->get_updated_date()) ? $item->get_updated_date() : Carbon::now(),
                'body' => ($item->get_content()) ? Html::entities($item->get_content()) : Html::entities($item->get_description()),
                'status' => 1
            ];

//            dd($insert);
            $validator = Validator::make($insert, [
                "feed_id" => "required|unique:feeds|max:255",
            ]);

            if ($validator->fails()){
                $errors[] = $validator;
            }else{
                $success++;
                $seed->feeds()->create($insert);
            }
        }
        if($success > 0){
            $seed->last_reload = Carbon::now();
            $seed->save();
        }
        return redirect()->route('seeds.index')
            ->with('success', trans_choice('seeds.successLoading',$success))
            ->withErrors($errors);
    }

    public function show($id)
    {

    }

    public function edit($seed)
    {
        $items = Category::all(['id', 'title']);
        return view('dashboard.seeds.edit', ['categories' => $items, 'data' => $seed]);
    }

    public function update(Request $request, $seed)
    {

    }
    public function destroy($seed)
    {
        //
    }
}
