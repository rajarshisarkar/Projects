package com.socialcops.challenge.rajarshi.app;

import java.util.ArrayList;
import android.app.Activity;
import android.app.Fragment;
import android.content.Context;
import android.content.res.Resources;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

public class FragmentOne extends Fragment {

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
	View view = inflater.inflate(R.layout.fragment_one, container, false);
	ArrayList<ListModel> myList = Getlist();
	Resources res = getResources();
	ListView lv = (ListView) view.findViewById(R.id.list);
	lv.setAdapter(new CustomAdapter(getActivity(), myList, res));

	return view;
    }

    public ArrayList<ListModel> Getlist() {
	ArrayList<ListModel> CustomListViewValuesArr = new ArrayList<ListModel>();
	
	for (int i = 1; i <= 20; i++) {
	    final ListModel listEntry = new ListModel();
	    listEntry.setData("Data No. " + i);
	    listEntry.setImage("ic_launcher");
	    CustomListViewValuesArr.add(listEntry);
	}

	return CustomListViewValuesArr;
    }

    public class CustomAdapter extends BaseAdapter {
	private Activity activity;
	private ArrayList<ListModel> data;
	private LayoutInflater inflater = null;
	public Resources res;
	ListModel tempValues = null;
	int i = 0;

	public CustomAdapter(Activity a, ArrayList<ListModel> d, Resources resLocal) {
	    activity = a;
	    data = d;
	    res = resLocal;
	    inflater = (LayoutInflater) activity.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
	}

	public int getCount() {
	    return data.size();
	}

	public Object getItem(int position) {
	    return position;
	}

	public long getItemId(int position) {
	    return position;
	}

	public class ViewHolder {
	    public TextView text;
	    public ImageView image;
	}

	public View getView(int position, View convertView, ViewGroup parent) {
	    View vi = convertView;
	    ViewHolder holder;

	    if (convertView == null) {
		vi = inflater.inflate(R.layout.customlistitem, null);
		holder = new ViewHolder();
		holder.text = (TextView) vi.findViewById(R.id.text);
		holder.image = (ImageView) vi.findViewById(R.id.image);
		vi.setTag(holder);
	    } else {
		holder = (ViewHolder) vi.getTag();
	    }

	    if (data.size() <= 0) {
		holder.text.setText("No Data");
	    } else {
		tempValues = null;
		tempValues = (ListModel) data.get(position);
		holder.text.setText(tempValues.getData());
		holder.image.setImageResource(res.getIdentifier("com.socialcops.challenge.rajarshi.app:drawable/" + tempValues.getImage(), null, null));
	    }
	    return vi;
	}
    }

    public class ListModel {
	private String Data = "";
	private String Image = "";

	public void setData(String data) {
	    this.Data = data;
	}

	public void setImage(String Image) {
	    this.Image = Image;
	}

	public String getData() {
	    return this.Data;
	}

	public String getImage() {
	    return this.Image;
	}
    }
}