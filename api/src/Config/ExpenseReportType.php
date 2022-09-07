<?php

namespace App\Config;

enum ExpenseReportType: string
{
case essence = 'essence';
case toll = 'péage';
case meal = 'repas';
case conference = 'conférence';
}
