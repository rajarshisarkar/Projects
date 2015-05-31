package com.thenewboston.rajarshi;

import java.util.Random;

import android.app.Activity;
import android.graphics.Color;
import android.os.Bundle;
import android.text.InputType;
import android.view.Gravity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.ToggleButton;

public class TextPlay extends Activity implements View.OnClickListener {

	Button chkCmd;
	ToggleButton passTog;
	EditText input;
	TextView display;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.text);
		bridgetoXML();
		passTog.setOnClickListener(this);
		chkCmd.setOnClickListener(this);
	}

	private void bridgetoXML() {
		// TODO Auto-generated method stub
		chkCmd = (Button) findViewById(R.id.bResults);
		passTog = (ToggleButton) findViewById(R.id.tbPassword);
		input = (EditText) findViewById(R.id.etCommands);
		display = (TextView) findViewById(R.id.tvResults);
	}

	@Override
	public void onClick(View v) {
		int id = v.getId();
		if (id == R.id.bResults) {
			String check = input.getText().toString();
			display.setText(check);
			if (check.contentEquals("left")) {
				display.setGravity(Gravity.LEFT);
				display.setTextColor(Color.BLACK);
			} else if (check.contentEquals("center")) {
				display.setGravity(Gravity.CENTER);
				display.setTextColor(Color.BLACK);
			} else if (check.contentEquals("right")) {
				display.setGravity(Gravity.RIGHT);
				display.setTextColor(Color.BLACK);
			} else if (check.contentEquals("blue")) {
				display.setTextColor(Color.BLUE);
			} else if (check.contentEquals("random")) {
				Random crazy = new Random();
				display.setText("Random");
				display.setTextSize(crazy.nextInt(75));
				display.setTextColor(Color.rgb(crazy.nextInt(255),
						crazy.nextInt(255), crazy.nextInt(255)));
				switch (crazy.nextInt(3)) {
				case 0:
					display.setGravity(Gravity.LEFT);
					break;
				case 1:
					display.setGravity(Gravity.CENTER);
					break;
				case 2:
					display.setGravity(Gravity.RIGHT);
					break;
				}
			} else {
				display.setText("Invalid");
				display.setGravity(Gravity.CENTER);
				display.setTextColor(Color.BLACK);
			}
		} else if (id == R.id.tbPassword) {
			if (passTog.isChecked()) {
				input.setInputType(InputType.TYPE_CLASS_TEXT
						| InputType.TYPE_TEXT_VARIATION_PASSWORD);
			} else {
				input.setInputType(InputType.TYPE_CLASS_TEXT);
			}
		}
	}
}
