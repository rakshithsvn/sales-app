<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Services\Thumb;

trait Indexable
{
    /**
     * The PostRepository instance.
     *
     * @var \App\Repositories\PostRepository
     */
    protected $repository;

    /**
     * The table.
     *
     * @var string
     */
    protected $table;

    /**
     * Display a listing of the records.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $parameters = $this->getParameters ($request);
        $search = ($request['search'])?$request['search']:null;
        // Get records and generate links for pagination
        if($search){
            $records = $this->repository->getAll (config ("app.nbrPages.back.$this->table"), $parameters,$search);
        }else{
            $records = $this->repository->getAll (config ("app.nbrPages.back.$this->table"), $parameters);
        }

        $links = $records->appends ($parameters)->links ('back.pagination');

        // Ajax response
        if ($request->ajax ()) {
            return response ()->json ([
                'table' => view ("back.$this->table.table", [$this->table => $records])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view ("back.$this->table.index", [$this->table => $records, 'links' => $links]);
    }

    /**
     * Get parameters.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getParameters($request)
    {
        // Default parameters
        $parameters = config("parameters.$this->table");

        // Build parameters with request
        if (is_array($parameters) || is_object($parameters))
        {
            foreach ($parameters as $parameter => &$value) {
                if (isset($request->$parameter)) {
                    $value = $request->$parameter;
                }
            }
        }

        return $parameters;
    }
}