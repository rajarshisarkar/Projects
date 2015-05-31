package com.thenewboston.rajarshi;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.TextView;

public class DataSharingBetweenActivities extends Activity implements
		OnClickListener {

	Button startFor;
	TextView gotAnswer;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.get);
		bridgetoXML();
		startFor.setOnClickListener(this);
	}

	private void bridgetoXML() {
		// TODO Auto-generated method stub
		startFor = (Button) findViewById(R.id.bGtNA);
		gotAnswer = (TextView) findViewById(R.id.tvGot);
	}

	@Override
	public void onClick(View v) {
		int id = v.getId();
		if (id == R.id.bGtNA) {
			Intent i = new Intent(DataSharingBetweenActivities.this,
					OpenedClass.class);
			startActivityForResult(i, 0);
		}
	}

	@Override
	protected void onActivityResult(int requestCode, int resultCode,
			Intent person) {
		// TODO Auto-generated method stub
		super.onActivityResult(requestCode, resultCode, person);
		if (resultCode == RESULT_OK) {
			Bundle backpack = person.getExtras();
			String s = backpack.getString("answer");
			gotAnswer.setText(s);
		}
	}
}
