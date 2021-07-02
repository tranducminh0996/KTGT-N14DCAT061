<?php

namespace App\Models;

use App\Models\Admin\Traits\BaseModel;
use GuzzleHttp\Psr7\Request;
use http\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athletic extends Model
{
    use HasFactory;

    protected $table = 'vgatour_athletic';

    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'weight',
        'height',
        'birthday',
        'turn_pro',
        'vga_id',
        'total_money'
    ];

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'vgatour_tournament_has_athletic');
    }

    public static function getTournamentWithAthletic($id)
    {
        $tournaments = Tournament::query()
            ->with([
                'athletics' => function ($query) {
                    $query->select(
                        'code_athletic',
                        'first_name',
                        'last_name',
                        'total_bonus',
                        'ranking',
                        'sort',
                        'is_cut'
                    )->orderBy('sort');
                }
            ])
            ->find($id);
        return $tournaments;
    }

    public static function getByCode($code)
    {
        $athletic = Athletic::query()->where('code_athletic', $code)->first();
        return $athletic;
    }

    public static function storeUpdate($params, $tournamentId)
    {
        $athletic = Athletic::query()->where('code_athletic', $params['code'])->first();
        if ($athletic !== null) {
            $athleticHasTournament = $athletic->tournaments()
                ->where('athletic_id', $athletic->id)
                ->where('tournament_id', $tournamentId)
                ->first();
            if ($athleticHasTournament !== null) {
                $athleticHasTournament
                    ->update(
                        [
                            'total_bonus' => $params['tong_tien_thuong'],
                            'ranking' => $params['xep_hang']
                        ]);
                return $athleticHasTournament;
            } elseif ($athleticHasTournament === null) {
                $athletic->tournaments()
                    ->attach($tournamentId, ['total_bonus' => $params['tong_tien_thuong'], 'ranking' => $params['xep_hang']]);
            }
            return $athletic;
        }

        if ($athletic === null) {
            return $params['code'];
        }
    }

}
