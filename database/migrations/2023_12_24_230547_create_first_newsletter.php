<?php

use App\Models\Newsletter\Newsletter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Newsletter::create([
			'content' => '
			È con grande entusiasmo che vi do il benvenuto nel nostro spazio dedicato all\'apprendimento e alla crescita personale!<br><br>
			
			A seguire troverai i dati di accesso per vedere le registrazioni del corso<br><br>
			
			Link di accesso: <a href="https://studiocollaborando.com/login">studiocollaborando.com/login</a><br>
			Username: <strong>{{ $email }}</strong><br>
			Password: <strong>studiocollaborando</strong><br><br>
			
			Troverai anche risorse gratuite per voi e i vostri bambini:<br><br>
			
			Per festeggiare la vostra presenza e felici feste abbiamo preparato un esclusivo fascicolo "Tabelline disegnate" creato per arricchire la vostra esperienza di apprendimento e quella dei vostri piccoli.<br><br>
			
			Il Vostro Impegno Fa la Differenza:<br><br>
			
			Ricordate, il semplice fatto che abbiate la volontà di informarvi e di attivarvi per migliorare lo stile di apprendimento dei vostri ragazzi sta già facendo la differenza. Siamo qui per supportarvi in ogni passo di questo viaggio educativo.<br><br>
			
			Grazie per aver scelto di far parte della nostra comunità di apprendimento. Siamo ansiosi di condividere questa avventura con voi!<br><br>
			
			
			Con entusiasmo,<br>
			Dott.ssa Sperandio Sara<br>
			www.studiocollaborando.com',

			'subject' => 'Benvenuti nel Nostro Spazio di Apprendimento!',
		]);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		DB::table('newsletters')->truncate();
	}
};
