<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\Kategori;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
      /**
       * The request instance.
       *
       * @var \Illuminate\Http\Request
       */
      private $request;
      public function __construct(Request $request)
      {
            $this->request = $request;
      }
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
            try {
                  $model = Kategori::paginate(20);
                  return response()->json([
                        'status' => true,
                        'message' => 'Berhasil',
                        'data' => $model,
                        'errors' => []
                  ], 200);
            } catch (Exception $e) {
                  return response()->json([
                        'status' => false,
                        'message' => 'gagal tidak ditemukan',
                        'data' => [],
                        'errors' => []
                  ], 404);
            }
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

                  $model = new Kategori; /// create model object
                  $validator = Validator::make($request->all(), $model->rules);
                  if ($validator->fails()) {
                        return response()->json([
                              'status' => false,
                              'message' => 'Gagal menambahkan data',
                              'data' => [],
                              'errors' => $validator->errors()
                        ], 404);
                  }
                  $request->merge(['id_kategori' => Str::uuid()->toString()]);
                  $kategori = Kategori::create($request->all());
                  return response()->json([
                        'status' => true,
                        'message' => 'Berhasil menambahkan data',
                        'data' => $kategori,
                        'errors' => []
                  ], 201);
            } catch (Exception $e) {
                  return $e;
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
            try {
                  $model = Kategori::where('id_kategori', $id)->first();
                  if ($model == null) {
                        return response()->json([
                              'status' => false,
                              'message' => 'data tidak ditemukan',
                              'data' => [],
                              'errors' => []
                        ], 404);
                  }
                  return response()->json([
                        'status' => true,
                        'message' => 'Berhasil',
                        'data' => $model,
                        'errors' => []
                  ], 200);
            } catch (Exception $e) {
                  return response()->json([
                        'status' => false,
                        'message' => $e->getMessage(),
                        'data' => [],
                        'errors' => []
                  ], 404);
            }
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
            $model = new Kategori; /// create model object
            $validator = Validator::make(
                  $request->all(),
                  $model->rules
            );
            if ($validator->fails()) {
                  return response()->json([
                        'status' => false,
                        'message' => 'Gagal mengubah data',
                        'data' => [],
                        'errors' => $validator->errors()
                  ], 404);
            }
            $kategori = Kategori::where('id_kategori', $id)->first();
            if ($kategori == null) {
                  return response()->json([
                        'status' => false,
                        'message' => 'Data tidak ditemukan',
                        'data' => [],
                        'errors' => []
                  ], 404);
            }

            $kategori->update($request->all());
            return response()->json([
                  'status' => true,
                  'message' => 'Berhasil mengubah data',
                  'data' => $kategori,
                  'errors' => []
            ], 200);
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
            $model = Kategori::where('id_kategori', $id)->first();
            if ($model == null) {
                  return response()->json([
                        'status' => false,
                        'message' => 'data tidak ditemukan',
                        'data' => [],
                        'errors' => []
                  ], 404);
            }
            if ($model->delete()) {
                  return response()->json([
                        'status' => true,
                        'message' => 'Berhasil menghapus data',
                        'data' => [],
                        'errors' => []
                  ], 200);
            } else {
                  return response()->json([
                        'status' => false,
                        'message' => 'Gagal menghapus data',
                        'data' => [],
                        'errors' => []
                  ], 404);
            }
      }
}
