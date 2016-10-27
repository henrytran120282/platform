<?php

namespace App\Modules\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\ContentManager\Models\Widget;
class WidgetGroups extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'widget_groups';
    public $timestamps = false;

    public function widget()
    {
        $widget = Widget::where("group_id",$this->id)->orderBy('order', 'asc')->get();
        return $widget;
    }
}
