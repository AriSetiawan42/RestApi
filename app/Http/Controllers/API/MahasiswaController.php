<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

use function PHPUnit\Framework\returnSelf;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mahasiswa::all();
        if ($data) {
            return ApiFormatter::creatApi(200, 'Succes', $data);
        } else {
            return ApiFormatter::creatApi(400, 'Failled');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'address' => 'required',
            ]);

            $mahasiswa = Mahasiswa::create([
                'username' => $request->username,
                'address' => $request->address
            ]);

            $data = Mahasiswa::where('id', '=', $mahasiswa->id)->get();

            if ($data) {
                if ($data) {
                    return ApiFormatter::creatApi(200, 'Succes', $data);
                } else {
                    return ApiFormatter::creatApi(400, 'Failled');
                }
            }
        } catch (Exception $error) {
            return ApiFormatter::creatApi(400, 'Failled');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Mahasiswa::where('id', '=', $id)->get();

        if ($data) {
            if ($data) {
                return ApiFormatter::creatApi(200, 'Succes', $data);
            } else {
                return ApiFormatter::creatApi(400, 'Failled');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'username' => 'required',
                'address' => 'required',
            ]);

            $mahasiswa = Mahasiswa::findOrfail($id);

            $mahasiswa->update([
                'username' => $request->username,
                'address' => $request->address
            ]);

            $data = Mahasiswa::where('id', '=', $mahasiswa->id)->get();

            if ($data) {
                if ($data) {
                    return ApiFormatter::creatApi(200, 'Succes', $data);
                } else {
                    return ApiFormatter::creatApi(400, 'Failled');
                }
            }
        } catch (Exception $error) {
            return ApiFormatter::creatApi(400, 'Failled');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);

            $data = $mahasiswa->delete();

            if ($data) {
                if ($data) {
                    return ApiFormatter::creatApi(200, 'Succes Destory data');
                } else {
                    return ApiFormatter::creatApi(400, 'Failled');
                }
            }
        } catch (Exception $error) {
            return ApiFormatter::creatApi(400, 'Failled');
        }
    }
}
