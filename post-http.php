// first working

        let url = URL(string: "https://url-here.com")!
        var request = URLRequest(url: url)
        request.httpMethod = "POST"
        request.httpBody = post_data.data(using: .utf8)
        URLSession.shared.dataTask(with: request) {
            (data, response, error) in
            if error == nil, let userObject = (try? JSONSerialization.jsonObject(with: data!, options: [])) {
                // you've got the jsonObject
            }
        }.resume()
        
// also an example at: https://www.raywenderlich.com/147086/alamofire-tutorial-getting-started-2
// reading material: https://developer.apple.com/documentation/foundation/urlsession/1407613-datatask


// example from: https://stackoverflow.com/questions/41745328/completion-handlers-in-swift-3-0
func getDataFromJson(url: String, parameter: String, completion: @escaping (_ success: [String : AnyObject]) -> Void) {

    //@escaping...If a closure is passed as an argument to a function and it is invoked after the function returns, the closure is @escaping.

    var request = URLRequest(url: URL(string: url)!)
    request.httpMethod = "POST"
    let postString = parameter

    request.httpBody = postString.data(using: .utf8)
    let task = URLSession.shared.dataTask(with: request) { Data, response, error in

        guard let data = Data, error == nil else {  // check for fundamental networking error

            print("error=\(error)")
            return
        }

        if let httpStatus = response as? HTTPURLResponse, httpStatus.statusCode != 200 {  // check for http errors

            print("statusCode should be 200, but is \(httpStatus.statusCode)")
            print(response!)
            return

        }

        let responseString  = try! JSONSerialization.jsonObject(with: data, options: .allowFragments) as! [String : AnyObject]
        completion(responseString)



    }
    task.resume()
}

getDataFromJson(url: "http://www.windmillinfotech.com/carlife/carlife_api/automotive_product_list", parameter: "vehicle_type=Car", completion: { response in
        print(response)

    })

// 2nd working:
func getInfo() {
        
        let method = "getInfo"
        let nonce = getNonce()
        let post_data = "method=\(method)&nonce=\(nonce)"
        let sign = getSign(post_data: post_data)
        dataRequest(url: self.tapiUrl, post_data: post_data, sign: sign, completion: { response in
            print(response)
        })
        
    }
    
    func dataRequest(url: String, post_data: String, sign: String, completion: @escaping (_ success: [String: Any]) -> Void) {

        let url = URL(string: url)!
        var request = URLRequest(url: url)
        request.setValue(self.key, forHTTPHeaderField: "key")
        request.setValue(sign, forHTTPHeaderField: "sign")
        request.httpMethod = "POST"
        request.httpBody = post_data.data(using: .utf8)
        URLSession.shared.dataTask(with: request) {
            (data, response, error) in
            
            guard let data = data, error == nil else {  // check for fundamental networking error
                
                print("error=\(String(describing: error))")
                return
            }
            
            if let httpStatus = response as? HTTPURLResponse, httpStatus.statusCode != 200 {  // check for http errors
                
                print("statusCode should be 200, but is \(httpStatus.statusCode)")
                print(response!)
                return
                
            }
            
            let responseString  = try! JSONSerialization.jsonObject(with: data, options: .allowFragments) as! [String : AnyObject]
            completion(responseString)

        }.resume()
    }

