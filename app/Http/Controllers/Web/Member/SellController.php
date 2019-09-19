<?php

namespace App\Http\Controllers\Web\Member;
use Auth;
use App\Models\Web\Categorie;
use App\Models\Area;
use App\Models\Sell;
use Illuminate\Http\Request;
use App\Helpers\Web\Paginator;
use App\Helpers\Web\Pcommon;

class SellController extends Controller
{
    public $parms = [
        'name' => '供应',
        'path' => 'sell',
    ];
    protected $fields = [
        'parent_id'=>'',
        'typeid'=>'',
        'areaid'=>'',
        'brand'=>'',
        'title' => '',
        'content' => '',
        'price' => '',
        'minamount' => '',
        'amount' => '',
        'litpic' => '',
        'company' => '',
        'telephone' => '',
        'address' => '',
        'email' => '',
        'qq' => '',
        'wx' => '',
        'author_id' => '',
        'status' => 0,
        'updated_at'=>'',
    ];

    public function __construct()
    {
        view()->share('parms', $this->parms);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status=2,$page=1)
    {
        $data['user'] = auth('web')->user();
        $list = Sell::where('author_id', $data['user']->id);
        if ($status < 2) {
            $list->where('status', $status);
        }
        $list = $list->orderBy('created_at', 'desc')->paginate(20, ['*'], 'page', $page);
        $data['list'] = $list;
        $data['status'] = $status;
        return view('web.member.sell.index', $data);
    }

    public function create()
    {
        $user = auth('web')->user();
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        return view('web.member.' . $this->parms['path'] . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new \App\Models\Sell();
        foreach (array_keys($this->fields) as $field) {
            $data->$field = $request->get($field, $this->fields[$field]);
        }
        $data->author_id = auth('web')->user()->id;
        $data->updated_at= date("Y-m-d H:i:s");
         // $data->save();
        try {
            \DB::transaction(function () use ($data) {
                $data->save();
            });
        } catch (\Exception $exception) {
            $this->error_log($exception);
            request()->flash();
            return back()->withErrors("失败了");
        }
        // return redirect('/member/sell');
        return redirect('/member/' . $this->parms['path'])->withSuccess('添加成功');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $user = auth('web')->user();
        $info = Sell::findOrFail($id);
        $data['id'] = $info->id;
        
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $info->$field);
        }
        return view('web.member.' . $this->parms['path'] . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth('web')->user();
        $data = Sell::findOrFail($id);
        foreach (array_keys($this->fields) as $field) {
            $data->$field = $request->get($field);
        }
        $data->author_id = auth('web')->user()->id;
        $data->updated_at= date("Y-m-d H:i:s");
        $data->save();
     
       return redirect('/member/sell');
    }


}