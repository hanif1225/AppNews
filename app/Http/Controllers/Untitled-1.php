<?php

class ContohController {

    function submitData(Request $request)
    {
        $data = new Data;
        $data->title = $request->title;

        if($data->save())
        {
            return response()->json([
                'status' => 1,
                'message' => 'Berhasil menyimpan Data',
                'data' => null
            ]);
        }
    }
}