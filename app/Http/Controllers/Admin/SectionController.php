<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function sections()
    {
        $sections = Section::get()->toArray();
        // dd($sections);
        return view('admin.sections.sections', compact('sections'));
    }


    public function updateSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }

    public function deleteSection($id)
    {
        Section::where('id', $id)->delete();
        $message = "Section has been deleted successfully!";

        return redirect()->back()->with('success_message', $message);
    }


    public function addEditSection(Request $request, $id=null){
        if($id == ''){
            $title = "Add Section";
            $section = new Section;
            $message = "Section added succesfully!";
        }else{
            $title = "Edit Section";
            $section = Section::find($id);
            $message = "Section updated successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $rules = [
                'section_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessage = [
                'section_name.required' => 'Section Name is required',
                'section_name.regex' => 'Valid name required'
            ];

            $this->validate($request,$rules,$customMessage);

            $section->name = $data['section_name'];
            $section->status = 1;
            $section->save();
            return redirect('admin/sections')->with('success_message',$message);
        }

        return view('admin.sections.add_edit_section',compact('title','section'));
    }
}
