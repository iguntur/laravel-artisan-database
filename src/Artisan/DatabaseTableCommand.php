<?php

namespace Guntur\Artisan;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:table
                            {table : The table name}
                            {--fields=all : Select with the specified field. Separate with `,` for multiple fields}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show the records of table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $thead = $this->tableFields();
        $tbody = $this->tableRows()->toArray();

        $this->table($thead, $tbody);
    }

    /**
     * Get the option field
     *
     * @return array
     */
    protected function getFieldOptions()
    {
        return explode(',', $this->option('fields'));
    }

    /**
     * Get table fields
     *
     * @return array
     */
    protected function tableFields()
    {
        $fields = DB::getSchemaBuilder()->getColumnListing($this->argument('table'));

        return $this->getFieldOptions()[0] === 'all'
            ? $fields
            : array_intersect($fields, $this->getFieldOptions());
    }

    /**
     * Get all records from table
     *
     * @return array
     */
    protected function tableRows()
    {
        $tbody = DB::table($this->argument('table'))->get();

        return $tbody->map(function ($field) {
            return $this->selectRowByField($field);
        });
    }

    /**
     * Selecting table row with associated field
     *
     * @param  string $field
     * @return array
     */
    protected function selectRowByField($field)
    {
        return collect($field)
                ->only($this->tableFields())
                ->toArray();
    }
}
