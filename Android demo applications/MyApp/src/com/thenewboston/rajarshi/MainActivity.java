package com.thenewboston.rajarshi;
import android.app.Activity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends Activity implements View.OnClickListener {
	int counter;
	Button add, sub;
	TextView display;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		bridgetoXML();
		add.setOnClickListener(this);
		sub.setOnClickListener(this);
	}

	private void bridgetoXML() {
		// TODO Auto-generated method stub
		counter = 0;
		add = (Button) findViewById(R.id.bAdd);
		sub = (Button) findViewById(R.id.bSub);
		display = (TextView) findViewById(R.id.tvDisplay);
	}

	@Override
	public void onClick(View v) {
		int id = v.getId();
		if (id == R.id.bAdd) {
			counter++;
			display.setText("Your total score is " + counter);
		} else if (id == R.id.bSub) {
			counter--;
			display.setText("Your total score is " + counter);
		}
	}
}
