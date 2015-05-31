package com.thenewboston.rajarshi;

import android.app.ListActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ArrayAdapter;
import android.widget.ListView;

public class Menu extends ListActivity {

	String classes[] = { "MainActivity", "TextPlay", "Camera",
			"DataSharingBetweenActivities", "GFX", "GFXSurface", "SoundStuff",
			"Slider", "Tabs", "SimpleBrowser", "Flipper", "SharedPrefs",
			"InternalData", "ExternalData", "SQLiteExample", "Accelerate",
			"HttpExample", "WeatherXMLParsing", "GLExample", "GLCubeEx",
			"Voice", "TextVoice", "StatusBar", "SeekBarVolume" };

	@Override
	protected void onListItemClick(ListView l, View v, int position, long id) {
		// TODO Auto-generated method stub
		super.onListItemClick(l, v, position, id);

		String activity = classes[position];
		try {
			Class ourClass = Class.forName("com.thenewboston.rajarshi."
					+ activity);
			Intent ourIntent = new Intent(Menu.this, ourClass);
			startActivity(ourIntent);
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		}

	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		/*
		// Fullscreen
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
				WindowManager.LayoutParams.FLAG_FULLSCREEN);
		*/
		setListAdapter(new ArrayAdapter<String>(Menu.this,
				android.R.layout.simple_list_item_1, classes));
	}

	@Override
	public boolean onCreateOptionsMenu(android.view.Menu menu) {
		// TODO Auto-generated method stub
		super.onCreateOptionsMenu(menu);
		MenuInflater inflateMenu = getMenuInflater();
		inflateMenu.inflate(R.menu.main, menu);
		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		int itemId = item.getItemId();
		if (itemId == R.id.aboutUs) {
			Intent i = new Intent("com.thenewboston.rajarshi.ABOUTUS");
			startActivity(i);
		} else if (itemId == R.id.preferences) {
			Intent p = new Intent("com.thenewboston.rajarshi.PREFERENCES");
			startActivity(p);
		} else if (itemId == R.id.exit) {
			finish();
		}
		return false;
	}
}
