<?php

namespace App\Observers;

use App\OfficialDocument;
use Illuminate\Support\Facades\Storage;

class OfficialDocumentObserver
{
    /**
     * Handle the official document "created" event.
     *
     * @param  \App\OfficialDocument  $officialDocument
     * @return void
     */
    public function created(OfficialDocument $officialDocument)
    {
        //
    }

    /**
     * Handle the official document "updated" event.
     *
     * @param  \App\OfficialDocument  $officialDocument
     * @return void
     */
    public function updated(OfficialDocument $officialDocument)
    {
        //
    }

    /**
     * Handle the official document "deleted" event.
     *
     * @param  \App\OfficialDocument  $officialDocument
     * @return void
     */
    public function deleted(OfficialDocument $officialDocument)
    {

    }
    /**
     * Handle the post "deleting" event.
     *
     * @param  \App\officialDocument  $officialDocument
     * @return void
     */
    public function deleting(OfficialDocument $officialDocument)
    {
        Storage::disk('public')->delete($officialDocument->folder_id.'/'.$officialDocument->file_name);
    }

    /**
     * Handle the official document "restored" event.
     *
     * @param  \App\OfficialDocument  $officialDocument
     * @return void
     */
    public function restored(OfficialDocument $officialDocument)
    {
        //
    }

    /**
     * Handle the official document "force deleted" event.
     *
     * @param  \App\OfficialDocument  $officialDocument
     * @return void
     */
    public function forceDeleted(OfficialDocument $officialDocument)
    {
        //
    }
}
