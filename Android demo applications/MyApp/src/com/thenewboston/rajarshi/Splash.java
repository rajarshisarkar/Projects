package com.thenewboston.rajarshi;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.media.MediaPlayer;
import android.os.Bundle;
import android.preference.PreferenceManager;

public class Splash extends Activity {

	MediaPlayer ourSong;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.splash);
		ourSong = MediaPlayer.create(Splash.this, R.raw.splashsound);

		SharedPreferences getPrefs = PreferenceManager
				.getDefaultSharedPreferences(getBaseContext());
		boolean music = getPrefs.getBoolean("mute", true);
		if (music == true)
			ourSong.start();

		Thread timer = new Thread() {
			public void run() {
				try {
					sleep(700);
				} catch (InterruptedException e) {
					e.printStackTrace();
				} finally {
					// Intent openMainActivity = new
					// Intent("com.thenewboston.rajarshi.MAINACTIVITY");
					Intent openMainActivity = new Intent(
							"com.thenewboston.rajarshi.MENU");
					startActivity(openMainActivity);
				}
			}
		};
		timer.start();
	}

	@Override
	protected void onPause() {
		// TODO Auto-generated method stub
		super.onPause();
		ourSong.release();
		finish();
	}
}
