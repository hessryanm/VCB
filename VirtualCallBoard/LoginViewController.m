//
//  LoginViewController.m
//  VirtualCallBoard
//
//  Created by Ryan Hess on 4/19/13.
//  Copyright (c) 2013 Ryan Hess. All rights reserved.
//

#import "LoginViewController.h"

@interface LoginViewController ()

@end

@implementation LoginViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view.
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (IBAction)logInSubmit:(id)sender {
    NSString * url = self.urlField.text;
    NSString * uname = self.userNameField.text;
    NSString * pass = self.passwordField.text;
    
    NSString * stay;
    if (self.stayLoggedInSwitch.on){
        stay = @"true";
    } else{
        stay = @"false";
    }
    
    NSDictionary * data = @{
        @"url":url,
        @"uname":uname,
        @"pass":pass,
        @"stay":stay
    };
    
    NSData * jsonData = [NSJSONSerialization dataWithJSONObject:data options:0 error:nil];
    
    NSString *jsonString = [[NSString alloc] initWithData:jsonData encoding:NSUTF8StringEncoding];
    
    NSLog(@"%@", jsonString);
}

- (BOOL)textFieldShouldReturn:(UITextField *)theTextField {
    if (theTextField == self.passwordField) {
        [theTextField resignFirstResponder];
    } else if (theTextField == self.urlField){
        [self.userNameField becomeFirstResponder];
    } else if (theTextField == self.userNameField){
        [self.passwordField becomeFirstResponder];
    }
    return YES;
}
@end
