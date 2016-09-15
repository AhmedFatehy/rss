<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Form;

class CategoriesController extends Controller
{
    protected $status_list = array(
        0 => ["danger" => 'categories.label.deactivate'],
        1 => ["success" => 'categories.label.activate'],
    );
    protected $columns_list = array(
        1 => "id",
        2 => "updated_at",
        3 => "title",
        4 => "children_count",
        5 => "seeds_count",
        6 => "feeds_count",
        7 => "status",
    );


    public function index()
    {
        return view('dashboard.categories.index', ['status' => $this->status_list]);
    }

    public function ajax(Request $request)
    {
        $sEcho = intval($_REQUEST['draw']);
        $records = array();
        $records["data"] = array();
        $recordsTotal = Category::all()->count();
        $records["recordsTotal"] = $recordsTotal;
        $items = new Category();
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
                            $action_items = new Category();
                            $action_items = $action_items->whereIn("id", $ids);
                        }
                    }
                    if (Input::get('customActionName') == 'activate') {
                        $action_items = $action_items->update(array('status' => 1));
                        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                        $records["customActionMessage"] = trans('categories.index.success_bulk_activate'); // pass custom message(useful for getting status of group actions)
                    }
                    if (Input::get('customActionName') == 'deactivate') {
                        $action_items = $action_items->update(array('status' => 0));
                        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                        $records["customActionMessage"] = trans('categories.index.success_bulk_deactivate'); // pass custom message(useful for getting status of group actions)
                    }
                    if (Input::get('customActionName') == 'delete') {
                        $action_items->children()->update(['parent_id'=>0]);
                        $action_items->seeds()->update(['category_id'=>0]);
                        $action_items->feeds()->update(['category_id'=>0]);
                        $action_items->destroy();
                        $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                        $records["customActionMessage"] = trans('categories.index.success_bulk_delete'); // pass custom message(useful for getting status of group actions)
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
                ($item->parent['title']) ? $item->parent['title'] . ' - ' . $item['title'] : $item['title'],
                $item->children()->count(),
                $item->seeds()->count(),
                $item->feeds()->count(),
                '<span class="label label-sm label-' . key($this->status_list[$item['status']]) . '">' .
                trans(current($this->status_list[$item['status']])) .
                '</span>',
                '<a href="' . route('categories.show', ['id' => $item['slug']]) . '" class="btn btn-sm btn-outline btn-success "><i class="fa fa-search"></i> ' . trans('app.read') . ' </a>'
                . '<a href="' . route('categories.edit', ['id' => $item['slug']]) . '" class="btn btn-sm btn-outline btn-warning "><i class="fa fa-pencil-square-o"></i> ' . trans('app.update') . ' </a>'
                . Form::open(['route' => ['categories.destroy',$item['slug']], 'method' => 'DELETE', 'style'=>'display:inline']).
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
        return view('dashboard.categories.create', ['categories' => $items]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "bail|required|unique:categories|max:255",
            "parent_id" => "nullable|exists:categories,id",
            "description" => "required",
            "status" => "nullable|accepted",
        ]);
        if ($validator->fails()) {
            return redirect()->route('categories.create')->withErrors($validator)->withInput();
        }
        $item = new Category([
            'title' => $request->input('title'),
            'parent_id' => ($request->input('parent_id')) ? $request->input('parent_id') : 0,
            'description' => $request->input('description'),
            'status' => ($request->input('status')) ? 1 : 0,
        ]);
        $item->save();
        return redirect()->route('categories.index')->with('success', trans('categories.create.success'));
    }

    public function show($id)
    {
    }

    public function edit($category)
    {
        $items = Category::all(['id', 'title']);
        return view('dashboard.categories.edit', ['categories' => $items, 'data' => $category]);
    }

    public function update(Request $request, $category)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'bail|required|max:255|unique:categories,title,' . $category['id'],
            "parent_id" => 'nullable|exists:categories,id,id,!' . $category['id'],
            "description" => "required",
            "status" => "nullable|accepted",
        ]);

        if ($validator->fails()) {
            return redirect()->route('categories.edit', ['slug' => $category->slug])->withErrors($validator)->withInput();
        }
        $category->title = $request->input('title');
        $category->parent_id = ($request->input('parent_id')) ? $request->input('parent_id') : 0;
        $category->description = $request->input('description');
        $category->status = ($request->input('status')) ? 1 : 0;
        $category->save();
        return redirect()->route('categories.edit', ['slug' => $category->slug])->with('success', 'تم تعديل التصنيف بنجاح');
    }

    public function destroy($category)
    {
        $category->children()->update(['parent_id'=>0]);
        $category->seeds()->update(['category_id'=>0]);
        $category->feeds()->update(['category_id'=>0]);
        $category->delete();
        return redirect()->route('categories.index')->withSuccess(trans('categories.deleting.success'));
    }

    public function getSettings()
    {
        return view('dashboard.categories.settings');
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }
}
