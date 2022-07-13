<?php

namespace App\Services;


class TableButtonService
{
    /**
     * @param $value
     * @param $modal_name
     * @return string
     */
    public function editButtonModal($value, $modal_name): string
    {
        return '<button data-toggle="modal" title="EDIT" data-target="#' . $modal_name . '"
            data-id="' . $value . '" class="btn btn-primary edit-button btn-flat btn-xs">
            <i class="fa fa-edit "></i>
            </button>';
    }

    /**
     * @param $route
     * @param $value
     * @return string
     */
    public function viewButton($route, $value): string
    {
        return '<a class="btn btn-default btn-xs btn-flat" data-container="body"
                   title="View"   href="' . route($route, $value) . '">
                   <i class="fa fa-eye "></i></a>&nbsp;';
    }

    /**
     * @param $route
     * @param $value
     * @return string
     */
    public function deleteButton($route, $value): string
    {
        return '<form method="POST" action="' . route($route, $value) . '"
                     onsubmit="return confirm(\'Are you sure you want to delete?\')" style="display: inline;">
                      <input type="hidden"  name="_token" value="' . csrf_token() . '">
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-danger btn-xs btn-flat" data-container="body"
                      title="Delete" data-placement="bottom" data-tooltip="tooltip"
                     role="button" type="submit">
                     <i class="fa fa-times"></i></button></form>';
    }

    /**
     * @param $route
     * @param $value
     * @return string
     */
    public function editButton($route, $value): string
    {
        return '<a class="btn btn-primary btn-xs btn-flat" data-container="body"
                   title="Edit"   href="' . route($route, $value) . '">
                     <i class="fa fa-edit "></i></a>';
    }

}
