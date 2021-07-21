<?php

namespace App\Admin\Controllers\Geo;

use App\Models\Geo\GeoList;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class GeoListController extends Controller
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
        $grid = new Grid(new GeoList);

        $grid->id('ID');
        $grid->geo_id('geo_id');
        $grid->geo_xml_id('geo_xml_id');
        $grid->is('is');
        $grid->cnt('cnt');
        $grid->country('country');
        $grid->federal('federal');
        $grid->region('region');
        $grid->city('city');
        $grid->value('value');
        $grid->text('text');
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
        $show = new Show(GeoList::findOrFail($id));

        $show->id('ID');
        $show->geo_id('geo_id');
        $show->geo_xml_id('geo_xml_id');
        $show->is('is');
        $show->cnt('cnt');
        $show->country('country');
        $show->federal('federal');
        $show->region('region');
        $show->city('city');
        $show->value('value');
        $show->text('text');
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
        $form = new Form(new GeoList);

        $form->display('ID');
        $form->text('geo_id', 'geo_id');
        $form->text('geo_xml_id', 'geo_xml_id');
        $form->text('is', 'is');
        $form->text('cnt', 'cnt');
        $form->text('country', 'country');
        $form->text('federal', 'federal');
        $form->text('region', 'region');
        $form->text('city', 'city');
        $form->text('value', 'value');
        $form->text('text', 'text');
        $form->display(trans('admin.created_at'));
        $form->display(trans('admin.updated_at'));

        return $form;
    }
}
