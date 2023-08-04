<?php

use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    const COUNTRIES = "countries", // id
        STATES = "states",
        MUNICIPALITIES = "municipalities",
        COLONIES = "colonies", 
        USERS = "user", // id
        ROLE_USERS = "role_user",
        ROLES = "roles";// id, name, city, zipcode 

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        self::createCountriesTable();
        self::createStatesTable();
        self::createMunicipalitiesTable();
        self::createColoniesTable();
        self::createUserTable();
        self::createRolUserTable();
        self::createRolesTable();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $drops = [
            self::COUNTRIES,
            self::STATES,
            self::MUNICIPALITIES,
            self::COLONIES,
            self::USERS,
            self::ROLE_USERS,
            self::ROLES,
            
        ];

        foreach ($drops as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }

    protected static function createCountriesTable()
    {
        Schema::create(self::COUNTRIES, function (Blueprint $table) {
            $table->id(); //unsigedBigInteger
            $table->string('name');
        });
    }

    public static function createStatesTable()
    {
        Schema::create(self::STATES, function (Blueprint $table) {
            $table->id(); //unsigedBigInteger
            $table->string('name');

            $table->foreignId('country1_id')->constrained();
            $table->foreignId('country2_id')->constrained();

            // $table->unsignedBigInteger('country_id');//column type name
            // $table->foreign('country_id')->references('id')->on(self::COUNTRIES);

            // //Llave foranea por medio de la clase
            // $table->foreignId(Country::class)->constrained();
            // //Magic, porque automaticamente detecta cual es la llave foranea
            // $table->foreignId('country_id')->constrained();

        });
    }
    public static function createMunicipalitiesTable()
    {
        Schema::create(self::MUNICIPALITIES, function (Blueprint $table) {
            $table->id(); //UnsigedBigInteger
            $table->string('name');
            $table->unsignedBigInteger('state_id');
            $table->foreign('municipalitie_id')->references('id')->on(self::MUNICIPALITIES);
        });
    }
    public static function createColoniesTable()
    {
        Schema::create(self::COLONIES, function (Blueprint $table) {
            $table->id(); //UnsigedBigInteger
            $table->string('name');
            $table->string('city');
            $table->string('zip_code');
            $table->unsignedBigInteger('municipalities_id');
            $table->foreign('municipalitie_id')->references('id')->on(self::COLONIES);
    });
    }

    public static function createUserTable()
    {
        Schema::create(self::USERS, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
    });
    }

    

    public static function createRolesTable()
    {
        Schema::create(self::ROLES, function (Blueprint $table) {
            $table->id();
            $table->string('name');
        
    });
    }

    public static function createRolUserTable()
    {
        Schema::create(self::ROLE_USERS, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('role_id')->constrained();
            
    });
    }
};
