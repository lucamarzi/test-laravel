<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $data = [
      [
          'name' => 'Luca',
          'lastname' => 'Marzi'
      ],
        [
            'name' => 'Riccardo',
            'lastname' => 'Marzi'
        ],
        [
            'name' => 'Matteo',
            'lastname' => 'Marzi'
        ],
    ];
    //
    public function about() {
        return view('about');
    }
    public function staff() {
    /*  return view('staff',
            [
                'title'=>'Our Staff',
                'staff' =>$this->data
            ]
        );*/

/*        return view('staff')
            ->with('title', 'Our Staff')
            ->with('staff', $this->data);*/

/*        return view('staff')
            ->withStaff($this->data)
            ->withTitle('Our Staff');*/

            $staff = $this->data;
            $title = 'Our Staff';
            return view('staff', compact('title','staff'));
    }

    public function blog() {
        $title = 'Blog';
        return view('blog', compact('title'));
    }

}
