 if (isset($_POST['EXPORT_SEARCH'])) {

        $displayfields = $_POST['DISPLAY_SEARCH'];

        $query_advancedsearch = $_POST['EXPORT_SEARCH'];

        if (isset($_POST['BEST_EXP'])) {
            //comitted array is assigned back to $export_arr
            $export_arr = unserialize(urldecode($_POST['BEST_EXP']));
            //var_dump($_POST);
            //if $export_arr is not empty, then...
            if (isset($export_arr) != FALSE) {

                $headkeys = array_keys($export_arr);
                $headline = "";

                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();

// Set document properties
                $objPHPExcel->getProperties()->setCreator("<author>")
                        ->setTitle("<title>");


                $objPHPExcel->setActiveSheetIndex(0);
                $objWorksheet = $objPHPExcel->getActiveSheet();
                $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
                $col_indx = 0; // column index
                foreach ($headkeys as $col) {
                    $objWorksheet->getCellByColumnAndRow($col_indx, 1)->setValue($export_arr[$col][1]);
                    $objWorksheet->getStyleByColumnAndRow($col_indx, 1)->getFont()->setBold(true);
                    $col_indx++;
                }

                $n_rows = count($export_arr['linenumber']);
                for ($r = 2; $r < $n_rows + 2; $r++) {

                    $ci = 0;
                    foreach ($headkeys as $col) {

                        //if cell is not empty...
                        if (isset($export_arr[$col][$r]) != 0) {
                            //...write value
                            $objWorksheet->getCellByColumnAndRow($ci, $r)->setValue($export_arr[$col][$r]);
                            $ci++;
                        }
                        //else skip cell
                        else {
                            $ci++;
                        }
                    }
                    //complete row   
                }

                $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '00000000'),
                        ),
                    ),
                );

                $i = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
                $j = $objPHPExcel->getActiveSheet()->getHighestDataRow();

                $objPHPExcel->getActiveSheet()->getStyle('A1:' . $i . $j)->applyFromArray($styleArray);

                for ($o = 0; $o < $col_indx; $o++) {
                    $objWorksheet->getColumnDimensionByColumn($o)->setAutoSize(TRUE);
                }


                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('ExcelExport');

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="ExcelExport.xls"');
                header('Cache-Control: max-age=0');

                $objWriter->save('php://output');

                exit();
            }
        }
    }