<?php

namespace App\Services;

use Revolution\Google\Sheets\Facades\Sheets;

class GoogleSheetService
{
    protected $spreadsheetId;

    public function __construct($spreadsheetId)
    {
        $this->spreadsheetId = $spreadsheetId;
    }

    public function getAllRows($sheetName)
    {
        return Sheets::spreadsheet($this->spreadsheetId)
            ->sheet($sheetName)
            ->all();
    }
}
