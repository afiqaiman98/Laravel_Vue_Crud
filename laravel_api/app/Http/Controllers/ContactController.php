<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(){
        $contacts = Contact::all();
        return response()->json(
            [
                'contacts'=>$contacts,
                'message'=>'Contacts',
                'code'=>200
            ]
            );
    }

   public function saveContact(Request $request){
    $contact = new Contact();
    $contact->name = $request->name;
    $contact->email = $request->email;
    $contact->designation = $request->designation;
    $contact->contact_no = $request->contact_no;
    $contact->save();
    return response()->json([
        'message'=>'Contact Created Succefully',
        'code'=>"200",
    ]);
   }

   public function deleteContact($id){
    $contact = Contact::find($id);
    if($contact){
        $contact->delete();
        return response()->json([
            'message'=>'Contact Delete Successfuly',
            'code'=>200
        ]);
    }else{
        return response()->json([
            'message'=>"COntact with id:$id does not exist"
        ]);
    }
   }

   public function editContact($id){
    $contact = Contact::find($id);
    if($contact){
        return response()->json([
            'contact' => $contact,
            'message' => 'Contact found',
            'code' => 200,
        ]);
    }else{
        return response()->json([
            'message' => "Contact with id: $id not found",
            'code' => 404,
        ], 404);
    }
}

public function updateContact(Request $request, $id){
    $contact = Contact::find($id);
    // $contact = Contact::where('id',$id)->first();
    if($contact){
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->contact_no = $request->contact_no;
        $contact->save();
        return response()->json([
            'message' => 'Contact updated successfully',
            'code' => 200,
        ]);
    }else{
        return response()->json([
            'message' => "Contact with id: $id not found",
            'code' => 404,
        ], 404);
    }
}



}
