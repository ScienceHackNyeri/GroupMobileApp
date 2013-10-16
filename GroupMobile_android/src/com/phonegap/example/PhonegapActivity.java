package com.phonegap.example;

import org.apache.cordova.DroidGap;
import android.os.Bundle;

public class PhonegapActivity extends DroidGap {
    
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        super.loadUrl("file:///android_asset/www/index.html");
    }
}