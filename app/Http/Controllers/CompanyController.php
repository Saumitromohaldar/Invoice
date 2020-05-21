<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;

class CompanyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // $request->validate([
        //     'name' => 'required',
        //     'email' =>'email'
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email',
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

        $company                = new \App\Company;
        $company->company_id    = uniqid();
        $company->name          = $request->name;
        $company->file_number   = $request->file_number;
        $company->country       = $request->country;
        $company->district      = $request->district;
        $company->city          = $request->city;
        $company->postcode      = $request->postcode;
        $company->address       = $request->address;
        $company->email         = $request->email;
        $company->phone_no      = $request->phone_no;

        $company->reg_no_online = $request->reg_no_online;
        $company->reg_no_manual = $request->reg_no_manual;
        $company->reg_date      =  date_format(date_create($request->reg_date),'Y-m-d');
        $company->reg_user_name = $request->reg_user_name;
        $company->reg_password  = $request->reg_password;
        $company->reg_email     = $request->reg_email;   

        
        $company->save();
        //return redirect()->back()->with('message', 'Company added successfully. ');
        if($company){
            //return response()->json(['success'=>'Company added successfully.']);
            $response = array(
                'status' => 'success',
                'message' => 'Company added successfully.',
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
    public function updateCompany(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email',
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

        $company             =  \App\Company::where('id',$id)->first();
        $company->name       = $request->name;
        $company->file_number= $request->file_number;
        $company->country    = $request->country;
        $company->district   = $request->district;
       // $company->city       = $request->city;
        $company->postcode   = $request->postcode;
        $company->address    = $request->address;
        $company->email      = $request->email;
        $company->phone_no   = $request->phone_no;

        $company->reg_no_online = $request->reg_no_online;
        $company->reg_no_manual = $request->reg_no_manual;
        $company->reg_date      =  date_format(date_create($request->reg_date),'Y-m-d');
        $company->reg_user_name = $request->reg_user_name;
        $company->reg_password  = $request->reg_password;
        $company->reg_email     = $request->reg_email;   


        $company->save();

        if($company){
            $response = array(
                'status' => 'success',
                'message' => 'Company updated successfully.',
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
    public function allCompanies(Request $request)
    {

        if(!empty($_GET['query'])){
            $search=trim($_GET['query']);
            $companies = \App\Company::where('name', 'like', '%' . $search . '%')
                                        ->orWhere('email', 'like', '%' . $search . '%')
                                        ->orWhere('phone_no', 'like', '%' . $search . '%')
                                        ->orderBy('created_at','DESC')
                                        ->paginate(15);
        }else{
            $companies = \App\Company::orderBy('created_at','DESC')->paginate(15);
        }

        $data['companies']=$companies;
        return view('backend.company.companies',$data);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function EditCompany($company_id)
    {
        $company = \App\Company::where('id',$company_id)->first();
        $data['company']=$company;
        return view('backend.company.edit-company',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function CreateCompany(Request $request)
    {

        return view('backend.company.create-company');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCompany($id)
    {
        $company = \App\Company::where('id',$id)->first();

       // return new CompanyResources($company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Company($id,$folder_id=1)
    {
        $company = \App\Company::where('id',$id)->first();
        $data['company']=$company;
        $data['invoices']=\App\Invoice::where('company_id',$id)->paginate(10);


        if(!empty($_GET['query'])){
            $search=trim($_GET['query']);
            $OfficialDocuments = \App\OfficialDocument::orderBy('created_at','DESC')
                                                        ->where('company_id',$id)
                                                        ->where('file_name', 'like', '%' . $search . '%')
                                                        ->get();
        }else{
            $OfficialDocuments = \App\OfficialDocument::orderBy('created_at','DESC')
                                                        ->where('company_id',$id)
                                                        ->where('folder_id',$folder_id)
                                                        ->get();
        }

        if(!empty($_GET['query'])){
            $folders = \App\Folder::orderBy('folder_name','ASC')
                                    ->where('company_id',$id)
                                    ->where('folder_name', 'like', '%' . $search . '%')
                                    ->get();
        }else{
            $folders = \App\Folder::orderBy('folder_name','ASC')
                                    ->where('company_id',$id)
                                    ->where('parent_id',$folder_id)
                                    ->get();
        }

        $data['documents']=$OfficialDocuments;
        $data['folders']=$folders;
        $data['folder_id']=!empty($folder_id)?$folder_id:1;


        return view('backend.company.company',$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteCompany(Request $request,$id)
    {
        \App\Company::where('id',$id)->delete();
        return redirect()->back()->with('message', 'Company deleted successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCompanyData(Request $request)
    {
        $company= \App\Company::where('id',$request->company_id)->first();

        // $response = array(
        //     'status' => 'fail',
        //     'message' => 'Something wrong please try again!',
        // );
        return Response::json($company);

    }



}
