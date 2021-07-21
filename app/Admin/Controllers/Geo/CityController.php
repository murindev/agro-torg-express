<?php

namespace App\Admin\Controllers\Geo;

use App\Models\Geo\City;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CityController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(trans('admin.index'))
            ->description(trans('admin.description'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header(trans('admin.detail'))
            ->description(trans('admin.description'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header(trans('admin.edit'))
            ->description(trans('admin.description'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header(trans('admin.create'))
            ->description(trans('admin.description'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new City);

        $grid->id('ID');
        $grid->slug('slug');
        $grid->code('code');
        $grid->sort('sort');
        $grid->geobase_id('geobase_id');
        $grid->country_id('country_id');
        $grid->federal_id('federal_id');
        $grid->region_id('region_id');
        $grid->title_ru('title_ru');
        $grid->created_at(trans('admin.created_at'));
        $grid->updated_at(trans('admin.updated_at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(City::findOrFail($id));

        $show->id('ID');
        $show->slug('slug');
        $show->code('code');
        $show->sort('sort');
        $show->geobase_id('geobase_id');
        $show->country_id('country_id');
        $show->federal_id('federal_id');
        $show->region_id('region_id');
        $show->title_ru('title_ru');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new City);

        $form->display('ID');
        $form->text('slug', 'slug');
        $form->text('code', 'code');
        $form->text('sort', 'sort');
        $form->text('geobase_id', 'geobase_id');
        $form->text('country_id', 'country_id');
        $form->text('federal_id', 'federal_id');
        $form->text('region_id', 'region_id');
        $form->text('title_ru', 'title_ru');
        $form->display(trans('admin.created_at'));
        $form->display(trans('admin.updated_at'));

        return $form;
    }
}
