<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class EmployeeImport implements ToModel,WithHeadingRow,WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Employee([
            'emp_id' => $row['employeeid'],
            'name'=> $row['fullname'],
            'job_title'=> $row['jobtitle'],
            'department'=> $row['department'],
            'business_unit'=> $row['businessunit'],
            'gender'=> $row['gender'],
            'age'=> $row['age'],
            'joining_date'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hiredate'])
                ->format('Y-m-d'),
            'annual_salary'=> $row['annualsalary'],
            'country'=> $row['country'],
            'city'=> $row['city']  
        ]);
    }
    public function rules(): array
    {
        return [
            'employeeid' => Rule::unique('employees', 'emp_id'),
        ];
    }

    
}
