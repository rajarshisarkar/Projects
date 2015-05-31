package com.thenewboston.rajarshi;

import android.app.Activity;
import android.app.Dialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class SQLiteExample extends Activity implements OnClickListener {

	Button sqlUpdate, sqlView, sqlModify, sqlGetInfo, sqlDelete;
	EditText sqlName, sqlageness, sqlRow;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.sqliteexample);
		sqlUpdate = (Button) findViewById(R.id.bSQLUpdate);
		sqlName = (EditText) findViewById(R.id.etSQLName);
		sqlageness = (EditText) findViewById(R.id.etSQLageness);
		sqlView = (Button) findViewById(R.id.bSQLopenView);
		sqlView.setOnClickListener(this);
		sqlUpdate.setOnClickListener(this);
		sqlRow = (EditText) findViewById(R.id.etSQLrowInfo);
		sqlModify = (Button) findViewById(R.id.bSQLmodify);
		sqlGetInfo = (Button) findViewById(R.id.bgetInfo);
		sqlDelete = (Button) findViewById(R.id.bSQLdelete);
		sqlDelete.setOnClickListener(this);
		sqlModify.setOnClickListener(this);
		sqlGetInfo.setOnClickListener(this);
	}

	public void onClick(View arg0) {
		int id = arg0.getId();
		if (id == R.id.bSQLUpdate) {
			boolean didItWork = true;
			try {
				String name = sqlName.getText().toString();
				String ageness = sqlageness.getText().toString();
				AgeOrNot entry = new AgeOrNot(SQLiteExample.this);
				entry.open();
				entry.createEntry(name, ageness);
				entry.close();
			} catch (Exception e) {
				didItWork = false;
				String error = e.toString();
				Dialog d = new Dialog(this);
				d.setTitle("Error!");
				TextView tv = new TextView(this);
				tv.setText(error);
				d.setContentView(tv);
				d.show();
			} finally {
				if (didItWork) {
					Dialog d = new Dialog(this);
					d.setTitle("Success!");
					TextView tv = new TextView(this);
					tv.setText("Data added to database successfully!");
					d.setContentView(tv);
					d.show();
				}
			}
		} else if (id == R.id.bSQLopenView) {
			Intent i = new Intent("com.thenewboston.rajarshi.SQLVIEW");
			startActivity(i);
		} else if (id == R.id.bgetInfo) {
			try {
				String s = sqlRow.getText().toString();
				long l = Long.parseLong(s);
				AgeOrNot hon = new AgeOrNot(this);
				hon.open();
				String returnedName = hon.getName(l);
				String returnedageness = hon.getageness(l);
				hon.close();
				sqlName.setText(returnedName);
				sqlageness.setText(returnedageness);
			} catch (Exception e) {
				String error = e.toString();
				Dialog d = new Dialog(this);
				d.setTitle("Error!");
				TextView tv = new TextView(this);
				tv.setText(error);
				d.setContentView(tv);
				d.show();
			}
		} else if (id == R.id.bSQLmodify) {
			try {
				String mName = sqlName.getText().toString();
				String mageness = sqlageness.getText().toString();
				String sRow = sqlRow.getText().toString();
				long lRow = Long.parseLong(sRow);
				AgeOrNot ex = new AgeOrNot(this);
				ex.open();
				ex.updateEntry(lRow, mName, mageness);
				ex.close();
			} catch (Exception e) {
				String error = e.toString();
				Dialog d = new Dialog(this);
				d.setTitle("Error!");
				TextView tv = new TextView(this);
				tv.setText(error);
				d.setContentView(tv);
				d.show();
			}
		} else if (id == R.id.bSQLdelete) {
			try {
				String sRow1 = sqlRow.getText().toString();
				long lRow1 = Long.parseLong(sRow1);
				AgeOrNot ex1 = new AgeOrNot(this);
				ex1.open();
				ex1.deleteEntry(lRow1);
				ex1.close();
			} catch (Exception e) {
				String error = e.toString();
				Dialog d = new Dialog(this);
				d.setTitle("Error!");
				TextView tv = new TextView(this);
				tv.setText(error);
				d.setContentView(tv);
				d.show();
			}
		}
	}
}