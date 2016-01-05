<?php
 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Chumper\Zipper\Zipper;
 
 
class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function download(Request $request)
    {
        $digits = 5;
        $build_string = 'milligram_custom_' . str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

        $temp_path = 'temp/' . $build_string . '.css';
        $temp = fopen($temp_path, 'a');

        $base = file_get_contents('milligram/Base.css');
        $blockquote = file_get_contents('milligram/Blockquote.css');
        $button = file_get_contents('milligram/Button.css');
        $code = file_get_contents('milligram/Code.css');
        $form = file_get_contents('milligram/Form.css');
        $grid = file_get_contents('milligram/Grid.css');
        $link = file_get_contents('milligram/Link.css');
        $list = file_get_contents('milligram/List.css');
        $misc = file_get_contents('milligram/Misc.css');
        $spacing = file_get_contents('milligram/Spacing.css');
        $table = file_get_contents('milligram/Table.css');
        $typography = file_get_contents('milligram/Typography.css');
        $utility = file_get_contents('milligram/Utility.css');

        if ($request->has('base'))
            file_put_contents($temp_path, $base, FILE_APPEND);
        if ($request->has('blockquote'))
            file_put_contents($temp_path, $blockquote, FILE_APPEND);
        if ($request->has('button'))
            file_put_contents($temp_path, $button, FILE_APPEND);
        if ($request->has('code'))
            file_put_contents($temp_path, $code, FILE_APPEND);
        if ($request->has('form'))
            file_put_contents($temp_path, $form, FILE_APPEND);
        if ($request->has('grid'))
            file_put_contents($temp_path, $grid, FILE_APPEND);
        if ($request->has('link'))
            file_put_contents($temp_path, $link, FILE_APPEND);
        if ($request->has('list'))
            file_put_contents($temp_path, $list, FILE_APPEND);
        if ($request->has('misc'))
            file_put_contents($temp_path, $misc, FILE_APPEND);
        if ($request->has('spacing'))
            file_put_contents($temp_path, $spacing, FILE_APPEND);
        if ($request->has('table'))
            file_put_contents($temp_path, $table, FILE_APPEND);
        if ($request->has('typography'))
            file_put_contents($temp_path, $typography, FILE_APPEND);
        if ($request->has('utility'))
            file_put_contents($temp_path, $utility, FILE_APPEND);

        fclose($temp);

        $zipper = new Zipper;
        $zipper->make('download/' . $build_string . '.zip')->add([$temp_path, 'temp/normalize.css']);
        $zipper->close();

        $download_path = rtrim(app()->basePath('public/'), '/') . "/download/" . $build_string . '.zip';

        return response()->download($download_path, $build_string . '.zip', [ 'Content-type' => 'application/zip' ]);
    }
}