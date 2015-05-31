package com.thenewboston.rajarshi;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class Email extends Activity implements View.OnClickListener {

	EditText personsEmail, personsName, intro, things, closingText;
	String emailAdd, name, introduction, PersonThings, closingT;
	Button sendEmail;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.email);
		bridgetoXML();
		sendEmail.setOnClickListener(this);
	}

	private void bridgetoXML() {
		// TODO Auto-generated method stub
		personsEmail = (EditText) findViewById(R.id.etEmails);
		personsName = (EditText) findViewById(R.id.etName);
		intro = (EditText) findViewById(R.id.etIntro);
		things = (EditText) findViewById(R.id.etThings);
		closingText = (EditText) findViewById(R.id.etClosing);
		sendEmail = (Button) findViewById(R.id.bSentEmail);

		emailAdd = personsEmail.getText().toString();
		name = personsName.getText().toString();
		introduction = intro.getText().toString();
		PersonThings = things.getText().toString();
		closingT = closingText.getText().toString();
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		String emailaddress[] = { emailAdd };
		String message = "Hi " + name + ". Your introuction is awesome! "
				+ ", I see you also love doing " + PersonThings + "\n"
				+ closingT + ".";

		Intent emailIntent = new Intent(android.content.Intent.ACTION_SEND);
		emailIntent.putExtra(android.content.Intent.EXTRA_EMAIL, emailaddress);
		emailIntent.putExtra(android.content.Intent.EXTRA_SUBJECT, "Take care!");
		emailIntent.setType("plain/text");
		emailIntent.putExtra(android.content.Intent.EXTRA_TEXT, message);
		startActivity(emailIntent);
	}

	@Override
	protected void onPause() {
		// TODO Auto-generated method stub
		super.onPause();
		finish();
	}
}
