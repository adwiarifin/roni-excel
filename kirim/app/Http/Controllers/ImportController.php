<?php

namespace App\Http\Controllers;

use App\Imports\SomethingImport;
use App\Models\Something;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{

    public function something()
    {
        $array = (new SomethingImport)->toArray('1. BIDANG URUSAN PENDIDIKAN.xls');
        $processed = $this->processArray($array);
        $this->saveArray($processed);
        echo "Import successfully";
    }

    private function processArray($array)
    {
        $max = count($array[0]);
        $deep = 5;
        $col = 0;
        $tmp = [];
        $result = [];
        for ($row = 3; $row < $max; $row++) {
            $cur = $array[0][$row];
            $produsen = $cur[7];
            $cell = $cur[$col];
            $cellSplit = explode(". ", $cell);
            if ($produsen != null) {
                if ($cell == null) {
                    for ($j = $col - 1; $j >= 0; $j--) {
                        if ($cur[$j] != null) {
                            $split = explode(". ", $cur[$j]);
                            $tmp[$j] = $split[1];
                            $col = $j + 1;
                            break;
                        } else {
                            array_pop($tmp);
                        }
                    }
                }
                $build = [];
                for ($j = 0; $j < $deep; $j++) {
                    $build[$j] = isset($tmp[$j]) ? $tmp[$j] : null;
                }
                if (count($cellSplit) > 1) {
                    $build[$col] = $cellSplit[1];
                } else {
                    $build[$deep - 1] = $cell;
                }
                $build[$deep + 0] = $cur[$deep + 0];
                $build[$deep + 1] = isset($cur[$deep + 1]) ? $cur[$deep + 1] : 0;
                $build[$deep + 2] = $cur[$deep + 2];
                $result[] = $build;
            } else {

                if ($cell != null) {
                    $tmp[] = $cellSplit[1];
                    $col++;
                } else {
                    for ($j = $col - 1; $j >= 0; $j--) {
                        if ($cur[$j] != null) {
                            $split = explode(". ", $cur[$j]);
                            $tmp[$j] = $split[1];
                            $col = $j + 1;
                            break;
                        } else {
                            array_pop($tmp);
                        }
                    }
                }
            }
        }
        return $result;
    }

    private function saveArray($array)
    {
        Something::truncate();
        for ($i=0; $i < count($array); $i++) {
            $row = $array[$i];
            $something = new Something();
            $something->level1 = $row[0];
            $something->level2 = $row[1];
            $something->level3 = $row[2];
            $something->level4 = $row[3];
            $something->kecamatan = $row[4];
            $something->satuan = $row[5];
            $something->value = $row[6];
            $something->produsen = $row[7];
            $something->save();
        }
    }
}
