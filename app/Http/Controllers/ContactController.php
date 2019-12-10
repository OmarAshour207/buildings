<?php

namespace App\Http\Controllers;

use App\Contact;
use App\User;
use Illuminate\Http\Request;
use Datatables;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index');
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request, Contact $contact)
    {
        $request_data = $request->except('_token');
        $request->validate([
            'name'          => 'required|string',
            'email'         => 'required|email',
            'message'       => 'required|string',
            'subject'       => 'required|integer'
        ]);
        Contact::create($request_data);
        session()->flash('success', 'تم أرسال رسالتك بنجاح');
        return redirect()->back();
    }

    public function edit(Contact $contact)
    {
        $contact->fill(['view'  => 1])->save();
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'name'      => 'required|string|min:5',
            'email'     => 'required|email',
            'subject'   => 'required|integer',
            'message'   => 'required|string'
        ]);
        $contact->update($data);
        session()->flash('success', 'تم تعديل الرساله بنجاح');
        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        session()->flash('success', 'تم حذف الرساله بنجاح');
        return redirect()->route('contacts.index');

    }

    public function anyData(Contact $contact)
    {
        $contacts = $contact->all();

        return DataTables::of($contacts)
            ->editColumn('subject', function ($model){
                $types = contact_type();
                return '<button class="btn btn-primary btn-sm">' . $types[$model->subject] . '</button>';
            })
            ->editColumn('status', function ($model) {
                if($model->view == 1) {
                    return '<button class="btn btn-primary btn-sm"> تمت مشاهدته </button>';
                } elseif ($model->view == 0) {
                    return '<button class="btn btn-info btn-sm"> لم يشاهد </button>';
                }
            })
            ->editColumn('action', function ($model){

                $all = '<a href= "' . url('adminpanel/contacts/'. $model->id .'/edit') . '" class="btn btn-info btn-circle" > <i class="fa fa-edit"></i> </a>';

                $all .=
                    '<form action="' .route('contacts.destroy', $model->id) .' " method="post" style="display: inline-block">
                        '.  csrf_field() .'  
                        '. method_field('delete') .'
                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i>                            
                        </button>
                    </form>';

                return $all;
            })->make(true);
    }
}
