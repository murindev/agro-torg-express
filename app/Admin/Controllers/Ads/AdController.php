<?php

namespace App\Admin\Controllers\Ads;

use App\Models\Ads\Ad;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AdController extends Controller
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
        $grid = new Grid(new Ad);

        $grid->id('ID');
        $grid->adds_id('adds_id');
        $grid->title('title');
        $grid->category('category');
        $grid->type('type');
        $grid->region('region');
        $grid->datetime('datetime');
        $grid->comments_cnt('comments_cnt');
        $grid->user_code('user_code');
        $grid->description('description');
        $grid->price('price');
        $grid->city('city');
        $grid->phone('phone');
        $grid->email('email');
        $grid->viewed('viewed');
        $grid->parsed('parsed');
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
        $show = new Show(Ad::findOrFail($id));

        $show->id('ID');
        $show->adds_id('adds_id');
        $show->title('title');
        $show->category('category');
        $show->type('type');
        $show->region('region');
        $show->datetime('datetime');
        $show->comments_cnt('comments_cnt');
        $show->user_code('user_code');
        $show->description('description');
        $show->price('price');
        $show->city('city');
        $show->phone('phone');
        $show->email('email');
        $show->viewed('viewed');
        $show->parsed('parsed');
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
        $form = new Form(new Ad);

        $form->display('ID');
        $form->text('adds_id', 'adds_id');
        $form->text('title', 'title');
        $form->text('category', 'category');
        $form->text('type', 'type');
        $form->text('region', 'region');
        $form->text('datetime', 'datetime');
        $form->text('comments_cnt', 'comments_cnt');
        $form->text('user_code', 'user_code');
        $form->text('description', 'description');
        $form->text('price', 'price');
        $form->text('city', 'city');
        $form->text('phone', 'phone');
        $form->text('email', 'email');
        $form->text('viewed', 'viewed');
        $form->text('parsed', 'parsed');
        $form->display(trans('admin.created_at'));
        $form->display(trans('admin.updated_at'));

        return $form;
    }
}
