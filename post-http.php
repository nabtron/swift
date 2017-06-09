
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
