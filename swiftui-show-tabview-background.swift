import SwiftUI

struct ContentView: View {

    init(){
      // this one adds bg without a line separating tabview
//        UITabBar.appearance().backgroundColor = UIColor(Color.red)
      // can be added here or onAppear
                        if #available(iOS 15.0, *) {
                            let appearance = UITabBarAppearance()
                            UITabBar.appearance().scrollEdgeAppearance = appearance
                        }
    }

    var body: some View {
            TabView() {
                Text("hello world!")
                    .tabItem {
                        Text("tab 1")
                    }
            }
      // we can either use it here or on init, both do the same thing
      // onAppear can also be used with tabItem
//            .onAppear {
//                if #available(iOS 15.0, *) {
//                    let appearance = UITabBarAppearance()
//                    UITabBar.appearance().scrollEdgeAppearance = appearance
//                }
//            }
    }
}

struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        ContentView()
    }
}
