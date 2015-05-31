package com.thenewboston.rajarshi;

import android.app.Activity;
import android.media.AudioManager;
import android.media.MediaPlayer;
import android.media.SoundPool;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.View.OnLongClickListener;
import android.widget.TextView;

public class SoundStuff extends Activity implements OnClickListener,
		OnLongClickListener {

	SoundPool sp;
	int explosion = 0;
	MediaPlayer mp;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.soundstuff);
		TextView t = (TextView) findViewById(R.id.tvSound);
		t.setOnClickListener(this);
		t.setOnLongClickListener(this);
		sp = new SoundPool(5, AudioManager.STREAM_MUSIC, 0);
		explosion = sp.load(this, R.raw.explosion, 1);
		mp = MediaPlayer.create(this, R.raw.backgroundmusic);
	}

	public void onClick(View v) {
		// TODO Auto-generated method stub
		if (explosion != 0)
			sp.play(explosion, 1, 1, 0, 0, 1);
	}

	public boolean onLongClick(View arg0) {
		// TODO Auto-generated method stub
		mp.start();
		return false;
	}

	@Override
	protected void onPause() {
		// TODO Auto-generated method stub
		super.onPause();
		mp.release();
	}
}
