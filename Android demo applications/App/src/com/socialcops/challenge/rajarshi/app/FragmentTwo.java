package com.socialcops.challenge.rajarshi.app;

import android.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import java.io.IOException;
import java.util.List;
import java.util.Locale;
import android.app.ActivityManager;
import android.app.AlertDialog;
import android.app.Service;
import android.app.ActivityManager.MemoryInfo;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.BatteryManager;
import android.os.IBinder;
import android.provider.Settings;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.view.View.OnClickListener;
import android.widget.Button;

public class FragmentTwo extends Fragment implements OnClickListener {
    TextView tvBatteryLevel, tvLocation, tvDeviceID, tvAvailableRAM;
    Button b;
    String device_id, availmem, batterylevel, stringLatitude, stringLongitude, country, city, postalCode, addressLine, locationNow;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
	View view = inflater.inflate(R.layout.fragment_two, container, false);

	TelephonyManager tm = (TelephonyManager) getActivity().getSystemService(Context.TELEPHONY_SERVICE);
	device_id = tm.getDeviceId() + "\n";

	MemoryInfo mi = new MemoryInfo();
	ActivityManager activityManager = (ActivityManager) getActivity().getSystemService(Context.ACTIVITY_SERVICE);
	activityManager.getMemoryInfo(mi);
	long availableMegs = mi.availMem / 1048576L;
	availmem = Long.toString(availableMegs) + " MB\n";

	IntentFilter ifilter = new IntentFilter(Intent.ACTION_BATTERY_CHANGED);
	Intent batteryStatus = getActivity().getApplicationContext().registerReceiver(null, ifilter);
	int level = batteryStatus.getIntExtra(BatteryManager.EXTRA_LEVEL, -1);
	int scale = batteryStatus.getIntExtra(BatteryManager.EXTRA_SCALE, -1);
	float batteryPct = (level * 100) / (float) scale;
	batterylevel = Float.toString(batteryPct) + " %\n";

	GPSTracker gpsTracker = new GPSTracker(getActivity());
	if (gpsTracker.canGetLocation()) {
	    stringLatitude = String.valueOf(gpsTracker.latitude);
	    stringLongitude = String.valueOf(gpsTracker.longitude);
	    country = gpsTracker.getCountryName(getActivity());
	    city = gpsTracker.getLocality(getActivity());
	    postalCode = gpsTracker.getPostalCode(getActivity());
	    addressLine = gpsTracker.getAddressLine(getActivity());
	    locationNow = addressLine + ", " + city + "-" + postalCode + ", " + country + " (Latitude: " + stringLatitude + ", Longitude: " + stringLongitude + ")\n";
	} else {
	    gpsTracker.showSettingsAlert();
	    locationNow = "Location is not accessible as GPS settings are disabled!\n";
	}

	tvBatteryLevel = (TextView) view.findViewById(R.id.textView2);
	tvLocation = (TextView) view.findViewById(R.id.textView3);
	tvDeviceID = (TextView) view.findViewById(R.id.textView4);
	tvAvailableRAM = (TextView) view.findViewById(R.id.textView5);
	b = (Button) view.findViewById(R.id.button1);
	tvBatteryLevel.setText("Battery Level: " + batterylevel);
	if (gpsTracker.canGetLocation()) {
	    tvLocation.setText("Current Location: " + locationNow);
	} else {
	    tvLocation.setText(locationNow);
	}
	tvDeviceID.setText("Device ID: " + device_id);
	tvAvailableRAM.setText("Available RAM: " + availmem);
	b.setOnClickListener(this);

	return view;
    }

    @Override
    public void onClick(View v) {
	// TODO Auto-generated method stub
	int id = v.getId();

	IntentFilter ifilter = new IntentFilter(Intent.ACTION_BATTERY_CHANGED);
	Intent batteryStatus = getActivity().registerReceiver(null, ifilter);
	int level = batteryStatus.getIntExtra(BatteryManager.EXTRA_LEVEL, -1);
	int scale = batteryStatus.getIntExtra(BatteryManager.EXTRA_SCALE, -1);
	float batteryPct = (level * 100) / (float) scale;
	batterylevel = Float.toString(batteryPct) + " %\n";

	GPSTracker gpsTracker = new GPSTracker(getActivity());
	if (gpsTracker.canGetLocation()) {
	    stringLatitude = String.valueOf(gpsTracker.latitude);
	    stringLongitude = String.valueOf(gpsTracker.longitude);
	    country = gpsTracker.getCountryName(getActivity());
	    city = gpsTracker.getLocality(getActivity());
	    postalCode = gpsTracker.getPostalCode(getActivity());
	    addressLine = gpsTracker.getAddressLine(getActivity());
	    locationNow = addressLine + ", " + city + "-" + postalCode + ", " + country + " (Latitude: " + stringLatitude + ", Longitude: " + stringLongitude + ")\n";
	} else {
	    gpsTracker.showSettingsAlert();
	    locationNow = "Location is not accessible as GPS settings are disabled!\n";
	}

	if (id == R.id.button1) {
	    tvBatteryLevel.setText("Battery Level: " + batterylevel);
	    if (gpsTracker.canGetLocation()) {
		tvLocation.setText("Current Location: " + locationNow);
	    } else {
		tvLocation.setText(locationNow);
	    }
	}
    }

    public class GPSTracker extends Service implements LocationListener {
	private final Context mContext;
	boolean isGPSEnabled = false, isNetworkEnabled = false, canGetLocation = false;
	Location location;
	double latitude, longitude;
	private static final long MIN_DISTANCE_CHANGE_FOR_UPDATES = 10;
	private static final long MIN_TIME_BW_UPDATES = 1000 * 60 * 1;
	protected LocationManager locationManager;

	public GPSTracker(Context context) {
	    this.mContext = context;
	    getLocation();
	}

	public Location getLocation() {
	    try {
		locationManager = (LocationManager) mContext.getSystemService(LOCATION_SERVICE);
		isGPSEnabled = locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER);
		isNetworkEnabled = locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);

		if (!isGPSEnabled && !isNetworkEnabled) {
		} else {
		    this.canGetLocation = true;

		    if (isNetworkEnabled) {
			locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, MIN_TIME_BW_UPDATES, MIN_DISTANCE_CHANGE_FOR_UPDATES, this);
			Log.d("Network", "Network");
			if (locationManager != null) {
			    location = locationManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
			    updateGPSCoordinates();
			}
		    }

		    if (isGPSEnabled) {
			if (location == null) {
			    locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, MIN_TIME_BW_UPDATES, MIN_DISTANCE_CHANGE_FOR_UPDATES, this);
			    Log.d("GPS Enabled", "GPS Enabled");
			    if (locationManager != null) {
				location = locationManager.getLastKnownLocation(LocationManager.GPS_PROVIDER);
				updateGPSCoordinates();
			    }
			}
		    }
		}
	    } catch (Exception e) {
		Log.e("Error : Location", "Impossible to connect to LocationManager", e);
	    }

	    return location;
	}

	public void updateGPSCoordinates() {
	    if (location != null) {
		latitude = location.getLatitude();
		longitude = location.getLongitude();
	    }
	}

	public void stopUsingGPS() {
	    if (locationManager != null) {
		locationManager.removeUpdates(GPSTracker.this);
	    }
	}

	public double getLatitude() {
	    if (location != null) {
		latitude = location.getLatitude();
	    }
	    return latitude;
	}

	public double getLongitude() {
	    if (location != null) {
		longitude = location.getLongitude();
	    }
	    return longitude;
	}

	public boolean canGetLocation() {
	    return this.canGetLocation;
	}

	public void showSettingsAlert() {
	    AlertDialog.Builder alertDialog = new AlertDialog.Builder(mContext);

	    alertDialog.setTitle("GPS Settings");
	    alertDialog.setMessage("GPS is not enabled. Do you want to go to settings menu and enable it?");
	    alertDialog.setPositiveButton("Settings", new DialogInterface.OnClickListener() {
		public void onClick(DialogInterface dialog, int which) {
		    Intent intent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
		    mContext.startActivity(intent);
		}
	    });
	    alertDialog.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
		public void onClick(DialogInterface dialog, int which) {
		    dialog.cancel();
		}
	    });

	    alertDialog.show();
	}

	public List<Address> getGeocoderAddress(Context context) {
	    if (location != null) {
		Geocoder geocoder = new Geocoder(context, Locale.ENGLISH);
		try {
		    List<Address> addresses = geocoder.getFromLocation(latitude, longitude, 1);
		    return addresses;
		} catch (IOException e) {
		    Log.e("Error : Geocoder", "Impossible to connect to Geocoder", e);
		}
	    }
	    return null;
	}

	public String getAddressLine(Context context) {
	    List<Address> addresses = getGeocoderAddress(context);

	    if (addresses != null && addresses.size() > 0) {
		Address address = addresses.get(0);
		String addressLine = address.getAddressLine(0);
		return addressLine;
	    } else {
		return null;
	    }
	}

	public String getLocality(Context context) {
	    List<Address> addresses = getGeocoderAddress(context);

	    if (addresses != null && addresses.size() > 0) {
		Address address = addresses.get(0);
		String locality = address.getLocality();
		return locality;
	    } else {
		return null;
	    }
	}

	public String getPostalCode(Context context) {
	    List<Address> addresses = getGeocoderAddress(context);

	    if (addresses != null && addresses.size() > 0) {
		Address address = addresses.get(0);
		String postalCode = address.getPostalCode();
		return postalCode;
	    } else {
		return null;
	    }
	}

	public String getCountryName(Context context) {
	    List<Address> addresses = getGeocoderAddress(context);

	    if (addresses != null && addresses.size() > 0) {
		Address address = addresses.get(0);
		String countryName = address.getCountryName();
		return countryName;
	    } else {
		return null;
	    }
	}

	@Override
	public void onLocationChanged(Location location) {
	}

	@Override
	public void onProviderDisabled(String provider) {
	}

	@Override
	public void onProviderEnabled(String provider) {
	}

	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) {
	}

	@Override
	public IBinder onBind(Intent intent) {
	    return null;
	}
    }
}