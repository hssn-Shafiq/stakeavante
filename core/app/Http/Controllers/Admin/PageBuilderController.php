<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class PageBuilderController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function allMenu(){

        $page_title = 'Menus';
        $empty_message = 'No menu found';
        $mainMenus =Menu::where('parent',0)->get();
        $pages =Page::orderBy('name')->get();
        $menus = Menu::latest()->paginate(getPaginate());
        return view('admin.frontend.builder.menu', compact('page_title', 'empty_message','mainMenus','menus','pages'));
    }

    public function addMenu(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'link'=>'required|string|max:255',
        ]);
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->order_value = $request->menu_order;
        $menu->parent = $request->parent?$request->parent:0;
        $menu->position = $request->position;
        $menu->link = $request->link;
        $menu->status = $request->status ? 1 : 0;
        $menu->save();
        $notify[] = ['success', 'Menu added successfully'];
        return back()->withNotify($notify);
    }

    public function updateMenu(Request $request){
    //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $menu = Menu::findOrFail($request->id);
        $menu->name = $request->name;
        $menu->order_value = $request->menu_order;
        $menu->parent = $request->parent?$request->parent:0;
        $menu->position = $request->position;
        if($request->link){
        $menu->link = $request->link;
        }
        $menu->status = $request->status ? 1 : 0;
        $menu->save();

        $notify[] = ['success', 'Menu updated successfully'];
        return back()->withNotify($notify);
    }

    public function managePages()
    {
        //// HOME PAGE
        $count = Page::where('tempname',$this->activeTemplate)->where('slug','home')->count();
        if($count == 0){
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'Home';
            $page->slug = 'home';
            $page->save();
        }

        $pdata = Page::where('tempname',$this->activeTemplate)->get();
        $page_title = 'Manage Pages';
        $empty_message = 'No Page Created Yet';

        return view('admin.frontend.builder.pages', compact('page_title','pdata','empty_message'));
    }

    public function managePagesSave(Request $request){

        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
        ]);

        $exist = Page::where('tempname', $this->activeTemplate)->where('slug', str_slug($request->slug))->count();
        if($exist != 0){
            $notify[] = ['error', 'This Page Already Exist on your Current Template. Please Change the Slug.'];
            return back()->withNotify($notify);
        }
        $page = new Page();
        $page->tempname = $this->activeTemplate;
        $page->name = $request->name;
        $page->slug = str_slug($request->slug);
        $page->save();
        $notify[] = ['success', 'Save Successfully'];
        return back()->withNotify($notify);

    }

    public function managePagesUpdate(Request $request){

        $page = Page::where('id',$request->id)->first();
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3'
        ]);

        $slug = str_slug($request->slug);

        $exist = Page::where('tempname', $this->activeTemplate)->where('slug',$slug)->first();
        if(($exist) && $exist->slug != $page->slug){
            $notify[] = ['error', 'This Page Already Exist on your Current Template. Please Change the Slug.'];
            return back()->withNotify($notify);
        }

        $page->name = $request->name;
        $page->slug = str_slug($request->slug);
        $page->save();


        $notify[] = ['success', 'Update Successfully'];
        return back()->withNotify($notify);

    }

    public function managePagesDelete(Request $request){
        $page = Page::where('id',$request->id)->first();
        $page->delete();
        $notify[] = ['success', 'Delete Successfully'];
        return back()->withNotify($notify);
    }



    public function manageSection($id)
    {
        $pdata = Page::findOrFail($id);
        $page_title = 'Manage Section of '.$pdata->name;
        $sections =  getPageSections(true);
        ksort($sections);
        return view('admin.frontend.builder.index', compact('page_title','pdata','sections'));
    }



    public function manageSectionUpdate($id, Request $request)
    {
        $request->validate([
            'secs' => 'nullable|array',
        ]);

        $page = Page::findOrFail($id);
        if (!$request->secs) {
            $page->secs = null;
        }else{
            $page->secs = json_encode($request->secs);
        }
        $page->save();
        $notify[] = ['success', 'Update Successfully'];
        return back()->withNotify($notify);
    }
}
