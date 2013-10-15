//
//  LoginViewController.h
//  VirtualCallBoard
//
//  Created by Ryan Hess on 4/19/13.
//  Copyright (c) 2013 Ryan Hess. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface LoginViewController : UIViewController
@property (weak, nonatomic) IBOutlet UITextField *urlField;
@property (weak, nonatomic) IBOutlet UITextField *userNameField;
@property (weak, nonatomic) IBOutlet UITextField *passwordField;
@property (weak, nonatomic) IBOutlet UISwitch *stayLoggedInSwitch;
- (IBAction)logInSubmit:(id)sender;

@end
