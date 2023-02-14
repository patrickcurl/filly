<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Tpetry\PostgresqlEnhanced\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::createExtensionIfNotExists('pg_trgm');
        Schema::createExtensionIfNotExists('citext');
    }
};
