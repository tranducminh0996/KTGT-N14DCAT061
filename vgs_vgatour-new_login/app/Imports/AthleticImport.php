<?php

namespace App\Imports;

use App\Models\Athletic;
use App\Models\Tournament;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use League\Flysystem\Exception;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class AthleticImport implements
    ToCollection,
    WithHeadingRow
//    SkipsOnError,
//    WithValidation,
//    SkipsOnFailure,
//    WithChunkReading,
//    ShouldQueue,
//    WithEvents
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public function collection(Collection $rows)
    {
        try {
            $this->errors = [];
            foreach ($rows as $row) {
                $athletic = Athletic::query()->where('code_athletic', $row['code'])->first();
                if ($athletic !== null) {
                    $athleticHasTournament = $athletic->tournaments()
                        ->where('athletic_id', $athletic->id)
                        ->where('tournament_id', $this->id)
                        ->first();
                    if ($athleticHasTournament !== null) {
                        $athletic->tournaments()
                            ->where('athletic_id', $athletic->id)
                            ->where('tournament_id', $this->id)
                            ->update(
                                [
                                    'total_bonus' => $row['tong_tien_thuong'],
                                    'ranking' => $row['thu_hang'],
                                    'sort' => $row['thu_tu'],
                                    'is_cut' => $row['cut']
                                ]);
                    } elseif ($athleticHasTournament === null) {
                        $athletic->tournaments()
                            ->attach(request('tournament'), ['total_bonus' => $row['tong_tien_thuong'], 'ranking' => $row['thu_hang'], 'is_cut' => $row['cut'], 'sort' => $row['thu_tu']]);
                    }
                }
                if ($athletic === null) {
                    $this->errors[] = 'Mã code' . ' ' . $row['code'] . ' ' . 'không tồn tại';
                    continue;
                }
            }
        } catch (Exception $e){
            return back()->withErrors($e->getMessage());
        }

    }

    public function onFailure(Failure ...$failures)
    {
        // TODO: Implement onFailure() method.
    }

    public function headingRow(): int
    {
        return 1;
    }

//    public function rules(): array
//    {
//        return [
//            '1' => 'required'
//        ];
//    }
//
//    public function validationMessages()
//    {
//        return [
//            '1.required' => trans()
//        ];
//    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public static function afterImport(AfterImport $event)
    {
        dd($event);
    }
}
