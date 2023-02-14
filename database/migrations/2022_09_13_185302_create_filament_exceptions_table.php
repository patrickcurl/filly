<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Tpetry\PostgresqlEnhanced\Schema\Blueprint;
use Tpetry\PostgresqlEnhanced\Support\Facades\Schema;

return new class() extends Migration {
    public function up()
    {
        Schema::create('filament_exceptions_table', function (Blueprint $table) {
            $table->id();
            $table->caseInsensitiveText('type', 255);
            $table->caseInsensitiveText('code');
            $table->caseInsensitiveText('message', 255);
            $table->caseInsensitiveText('file', 255);
            $table->integer('line');
            $table->text('trace');
            $table->caseInsensitiveText('method');
            $table->caseInsensitiveText('path', 255);
            $table->text('query');
            $table->text('body');
            $table->text('cookies');
            $table->text('headers');
            $table->caseInsensitiveText('ip');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('filament_exceptions_table');
    }
};
