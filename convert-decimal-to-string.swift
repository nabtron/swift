//We can convert decimal to string by:

        totalOutlet.stringValue =  String(format: "%.2f", summary["total"]!)
        
        // where summary is a dictionary<String,Double> and returns an optional value. 
        // So ! makes the value non-optional, and the remaining changes it to string after giving only 2 decimal points
