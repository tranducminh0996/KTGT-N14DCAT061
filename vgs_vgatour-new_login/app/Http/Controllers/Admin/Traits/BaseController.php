<?php

namespace App\Http\Controllers\Admin\Traits;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helper;
use Symfony\Component\HttpFoundation\RedirectResponse;

trait BaseController
{
    /**
     *  Delete data
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        try {
            $data = $this->model::getById($id);
            if (!$data) {
                throw new NotFoundRecord();
            }
            $data->delete();
            return redirect()->back()->with(Helper::MESSAGE_SUCCESS, __('message.action.delete_success'));
        } catch (\Throwable $throw) {
            return redirect()->back()->withErrors($throw->getMessage());
        }
    }
}
