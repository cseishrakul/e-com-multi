<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Session;

class CmsController extends Controller
{
    public function cmsPages()
    {
        Session::put('page', 'cmspages');
        $cms_pages = CmsPage::get()->toArray();
        return view('admin.pages.cms_pages', compact('cms_pages'));
    }
}
