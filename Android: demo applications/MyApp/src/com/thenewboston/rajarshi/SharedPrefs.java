package com.thenewboston.rajarshi;

import android.app.Activity;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class SharedPrefs extends Activity implements OnClickListener{

	EditText sharedData;
	TextView dataResults;
	public static String sharedprefname = "Folder";
	SharedPreferences sharedpref;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.sharedpreferences);
		bridgetoXML();
		sharedpref = getSharedPreferences(sharedprefname, 0);
	}

	private void bridgetoXML() {
		// TODO Auto-generated method stub
		Button save = (Button) findViewById(R.id.bSave);
		Button load = (Button) findViewById(R.id.bLoad);
		sharedData = (EditText) findViewById(R.id.etSharedPrefs);
		dataResults = (TextView) findViewById(R.id.tvLoadSharedPrefs);
		save.setOnClickListener(this);
		load.setOnClickListener(this);
	}

	public void onClick(View v) {
		int id = v.getId();
		if (id == R.id.bSave) {
			String stringData = sharedData.getText().toString();
			SharedPreferences.Editor editor = sharedpref.edit();
			editor.putString("File", stringData);
			editor.commit();
		} else if (id == R.id.bLoad) {
			sharedpref = getSharedPreferences(sharedprefname, 0);
			String dataReturned = sharedpref.getString("File",
					"Couldn't Load Data");
			dataResults.setText(dataReturned);
		}
	}
}
