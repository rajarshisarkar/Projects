package com.thenewboston.rajarshi;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;
import android.view.View;
import android.widget.EditText;

public class HttpExample extends Activity {

	private String url1 = "http://api.openweathermap.org/data/2.5/weather?q=";
	private EditText location, country, temperature;
	private HandleJSON obj;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.httpex);
		location = (EditText) findViewById(R.id.editText1);
		country = (EditText) findViewById(R.id.editText2);
		temperature = (EditText) findViewById(R.id.editText3);
	}

	public void open(View view) {
		String url = location.getText().toString();
		String finalUrl = url1 + url;
		obj = new HandleJSON(finalUrl);
		obj.fetchJSON();

		while (obj.parsingComplete);
		country.setText(obj.getCountry());
		float kelvin = Float.parseFloat(obj.getTemperature()) - 273.0f;
		String c = Float.toString(kelvin);
		temperature.setText(c + " °C");
	}
}