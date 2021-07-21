<?php


namespace App\Admin\Controllers\Parsers;


use App\Http\Controllers\Controller;
use App\Models\Geo\Country;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class FermerRu extends Controller
{
    protected $geo = [];

    public function makeGeo(){
        $geo = Country::with(['federals.regions.cities'])->get()->toArray();
        $newArr = [];

        foreach ($geo as $country){
            $newArr[] = [
              'key' => $country['title_ru'],
              'title' => $country['title_ru'],
            ];
            foreach ($country['federals'] as $federal){
                $newArr[] = [
                    'key' => $federal['title_ru'],
                    'title' => '- '.$federal['title_ru'],
                ];
                foreach ($federal['regions'] as $region){
                    $newArr[] = [
                        'key' => $region['title_ru'],
                        'title' => '- - '.$region['title_ru'],
                    ];
                    foreach ($region['cities'] as $city){
                        $newArr[] = [
                            'key' => $city['title_ru'],
                            'title' => '- - - '.$city['title_ru'],
                        ];
                    }
                }
            }
        }

        $this->geo = json_encode($newArr);
    }



    public function index(Content $content)
    {
        $this->makeGeo();
        Admin::js("/js/fermer.ru.js");

        return $content
            ->title('Парсеры')
            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->append("<div id='fermer_ru' ><fermer-ru :geo='" . $this->geo . "'/></div>");
                });
            });
    }

}
