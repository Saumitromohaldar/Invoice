<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Response;
use Illuminate\Support\Facades\Storage;


class DocumentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function officialDocuments($folder_id=1)
    {
        if(!empty($_GET['query'])){
            $search=trim($_GET['query']);
            $OfficialDocuments = \App\OfficialDocument::orderBy('created_at','DESC')->whereNull('company_id')->where('file_name', 'like', '%' . $search . '%')->get();
        }else{
            $OfficialDocuments = \App\OfficialDocument::orderBy('created_at','DESC')->where('folder_id',$folder_id)->whereNull('company_id')->get();
        }

        if(!empty($_GET['query'])){
            $folders = \App\Folder::orderBy('folder_name','ASC')->whereNull('company_id')->where('folder_name', 'like', '%' . $search . '%')->get();
        }else{
            $folders = \App\Folder::orderBy('folder_name','ASC')->whereNull('company_id')->where('parent_id',$folder_id)->get();
        }

        $data['documents']=$OfficialDocuments;
        $data['folders']=$folders;
        $data['folder_id']=!empty($folder_id)?$folder_id:1;
        return view('backend.document.documents',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveDocument(Request $request,$folder_id,$company_id=null)
    {



        $validator = Validator::make($request->all(), [
           // 'title' => 'required',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }



        $uploadedFile = $request->file('file');
        $filename = time().'-'.trim($uploadedFile->getClientOriginalName());


        Storage::disk('public')->putFileAs($folder_id,
            $uploadedFile,
            $filename
        );

        $upload             = new \App\OfficialDocument;
        $upload->folder_id=$request->folder_id;

        if(!empty($company_id)){
            $upload->company_id   =$company_id;
        }

        $upload->title      = $uploadedFile->getClientOriginalName();
        $upload->file_name  = $filename;
        $upload->file_type  =$request->file->getMimeType();

        $upload->save();


        //return redirect()->back()->with('message', 'Company added successfully. ');
        if($upload){
            //return response()->json(['success'=>'Company added successfully.']);
            $response = array(
                'status' => 'success',
                'message' => 'Document added successfully.',
            );
            return Response::json($response);
        }else{
            $response = array(
                'status' => 'fail',
                'message' => 'Something wrong please try again!',
            );
            return Response::json($response);
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFolder(Request $request,$folder_id,$company_id=null)
    {



        $validator = Validator::make($request->all(), [
            'folder_name' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }



        $upload              = new \App\Folder;
        $upload->folder_name =$request->folder_name;
        $upload->parent_id   =$folder_id;
        if(!empty($company_id)){
            $upload->company_id   =$company_id;
        }
        $upload->save();


        //return redirect()->back()->with('message', 'Company added successfully. ');
        if($upload){
            //return response()->json(['success'=>'Company added successfully.']);
            $response = array(
                'status' => 'success',
                'message' => 'Folder created successfully.',
            );
            return Response::json($response);
        }else{
            $response = array(
                'status' => 'fail',
                'message' => 'Something wrong please try again!',
            );
            return Response::json($response);
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteDocument(Request $request,$id)
    {
        $document=\App\OfficialDocument::where('id',$id)->first();
        Storage::delete('public/'.$document->file_name);

        $document->delete();
        return redirect()->back()->with('message', 'Document deleted successfully.');
    }

    public function downloadDocument($document_id)
    {
        $document=\App\OfficialDocument::where('id',$document_id)->first();

        return Storage::download('public/'.$document->folder_id.'/'.$document->file_name);
    }



    public function deleteFolder($id)
    {
        $folder=\App\Folder::where('id',$id)->first();

       // deleteFolder($folder);
       $folder->deleteChildFolders($folder->childrenFolders);


        Storage::disk('public')->deleteDirectory($id);

        $folder->delete();
        return redirect()->back()->with('message', 'Folder deleted successfully.');
    }

    public function deleteFile($id)
    {

        $file=\App\OfficialDocument::where('id',$id)->first();
        //Storage::disk('public')->delete($file->file_name);
        $file->delete();
        return redirect()->back()->with('message', 'File deleted successfully.');

    }


}
