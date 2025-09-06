<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyPhoto;
use App\Models\PropertyVideo;
use App\Models\Agent;
use App\Models\Location;
use App\Models\Type;

class FrontController extends Controller
  {     
    public function index()
    {
        // $properties = Property::where('status', 'Active')->where('is_featured','Yes')
        //     // ->whereHas('agent', function($query) {
        //     //     $query->whereHas('orders', function($q) {
        //     //         $q->where('currently_active', 1)
        //     //             ->where('status', 'Completed')
        //     //             ->where('expire_date', '>=', now());
        //     //     });
        //     // })
        // ->orderBy('id', 'asc')
        // ->take(3)
        // ->get();

        $properties = Property::where('status', 'Active')
                                ->where('is_featured','Yes')
                                 ->where(function($q) {
                                 $q->whereHas('agent.orders', function($qq) {
                                 $qq->where('currently_active', 1)
                                ->where('status', 'Completed')
                                ->where('expire_date', '>=', now());
                              })
                                ->orDoesntHave('agent.orders'); // allow if no orders
                                  })
                           ->orderBy('id', 'asc')
                            ->take(3)
                            ->get();

        // get the total propertywise locations. which location has more property, that will come first and in this way.
        $locations = Location::withCount(['properties' => function ($query) {
            $query->where('status', 'Active')
            ->whereHas('agent', function($q) {
                $q->whereHas('orders', function($qq) {
                    $qq->where('currently_active', 1)
                        ->where('status', 'Completed')
                        ->where('expire_date', '>=', now());
                });
            });
        }])->orderBy('properties_count', 'desc')->take(4)->get();

        $search_locations = Location::orderBy('name', 'asc')->get();
        $search_types = Type::orderBy('name', 'asc')->get();
        $agents = Agent::where('status', 1)->orderBy('id', 'asc')->take(4)->get();
       
        
        return view('front.home', compact('properties', 'locations', 'agents', 'search_locations', 'search_types'));
   }

    public function contact()
    {
        return view('front.contact');
    }

    public function select_user()
    {
        return view('front.select_user');
    }
    public function pricing()
    {
        $packages = Package::orderBy('id','asc')->get();
        return view('front.pricing', compact('packages'));
    }

    public function property_detail($slug)
    {
        $property = Property::where('slug', $slug)->first();
        if (!$property) {
            return redirect()->route('front.home')->with('error', 'Property not found');
        }

        return view('front.property_detail', compact('property'));
    }

      public function property_send_message(Request $request,$id)
    {
        $property = Property::where('id',$id)->first();
        if (!$property) {
            return redirect()->route('home')->with('error', 'Property not found');
        }

        // Send Email
        $subject = 'Property Inquiry';
        $message = 'You have received a new inquiry for the property: ' . $property->name.'<br><br>';
        $message .= 'Visitor Name:<br>'.$request->name.'<br><br>';
        $message .= 'Visitor Email:<br>'.$request->email.'<br><br>';
        $message .= 'Visitor Phone:<br>'.$request->phone.'<br><br>';
        $message .= 'Visitor Message:<br>'.nl2br($request->message);

        $agent_email = $property->agent->email;
        \Mail::to($agent_email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Message sent successfully to agent');
    }

    
    public function locations()
    {
        // get the total propertywise locations. which location has more property, that will come first and in this way.
        $locations = Location::withCount(['properties' => function ($query) {
            $query->where('status', 'Active')
            ->whereHas('agent', function($q) {
                $q->whereHas('orders', function($qq) {
                    $qq->where('currently_active', 1)
                        ->where('status', 'Completed')
                        ->where('expire_date', '>=', now());
                });
            });
        }])->orderBy('properties_count', 'desc')->paginate(20);

        return view('front.locations', compact('locations'));
    }

     public function location($slug) 
    {
        $location = Location::where('slug', $slug)->first();
        if (!$location) {
            return redirect()->route('front.locations')->with('error', 'Location not found');
        }

        $properties = Property::where('location_id', $location->id)
            ->where('status', 'Active')
            ->whereHas('agent', function($query) {
                $query->whereHas('orders', function($q) {
                    $q->where('currently_active', 1)
                        ->where('status', 'Completed')
                        ->where('expire_date', '>=', now());
                });
            })
        ->orderBy('id', 'asc')
        ->paginate(6);
        
        return view('front.location', compact('location', 'properties'));
    }
}
