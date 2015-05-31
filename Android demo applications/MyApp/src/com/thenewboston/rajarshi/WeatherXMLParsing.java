package com.thenewboston.rajarshi;

import java.net.URL;

import javax.xml.parsers.SAXParser;
import javax.xml.parsers.SAXParserFactory;

import org.xml.sax.InputSource;
import org.xml.sax.XMLReader;

import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import java.io.IOException;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.ParseException;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;
import android.view.View;
import android.widget.EditText;

public class WeatherXMLParsing extends Activity {

	private String url1 = "http://api.openweathermap.org/data/2.5/weather?q=";
	private String url2 = "&mode=xml";
	private EditText location, country, temperature;
	private HandleXML obj;

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
		String finalUrl = url1 + url + url2;
		country.setText(finalUrl);
		obj = new HandleXML(finalUrl);
		obj.fetchXML();
		while (obj.parsingComplete);
		country.setText(obj.getCountry());
		float kelvin = Float.parseFloat(obj.getTemperature()) - 273.0f;
		String c = Float.toString(kelvin);
		temperature.setText(c + " °C");
	}
}