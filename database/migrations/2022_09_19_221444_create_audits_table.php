<?php declare(strict_types=1);

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Migrations\Migration;
use Tpetry\PostgresqlEnhanced\Schema\Blueprint;
use Tpetry\PostgresqlEnhanced\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('audit.drivers.database.connection', config('database.default')))->create('audits', function (Blueprint $table) {
            $table->id('id');
            $table->nullableMorphs('owner');
            $table->string('event');
            $table->morphs('auditable');
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->caseInsensitiveText('url')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->caseInsensitiveText('user_agent')->nullable();
            $table->caseInsensitiveText('tags')->nullable();
            $table->timestamps();
        });

        Schema::connection(config('audit.drivers.database.connection', config('database.default')))->table('audits', function (Blueprint $table) {
            $morphPrefix = Config::get('audit.user.morph_prefix', 'user');
            $table->index('event');
            $table->index([$morphPrefix . '_id', $morphPrefix . '_type']);
            $table->index(['auditable_id', 'auditable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('audit.drivers.database.connection', config('database.default')))->drop('audits');
    }
}
